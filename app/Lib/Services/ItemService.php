<?php

namespace App\Lib\Services;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemService
{
    const DEFAULT_LIMIT = 12;

    public function get(array $input)
    {
        $query = Item::orderBy('updated_at', 'desc');

        if (isset($input['category'])) {
            $query = $query->where('category', $input['category']);
        }

        if (isset($input['ids'])) {
            $query = $query->whereIn('id', $input['ids']);
        }

        return $query->simplePaginate($input['limit'] ?? self::DEFAULT_LIMIT)
            ->withQueryString()
            ->through(function ($item) {
                return new ItemResource($item);
            });
    }

    public function find(int $id)
    {
        Validator::make(['id' => $id], [
            'id' => ['required', 'integer']
        ])->validate();

        return new ItemResource(Item::findOrFail($id));
    }

    public function create(array $input)
    {
        Validator::make($input, [
            'file' => ['required', 'file', 'image', 'max:8192'],
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'string', 'min:0'],
            'category' => ['required', 'string', 'min:0'],
            'description' => ['string'],
        ])->validate();

        $filename = uniqid('item_',true) . '.' . $input['file']->getClientOriginalExtension();

        $data = $input;
        $data['file'] = $filename;

        Storage::putFileAs('public/items', $input['file'], $filename);

        return Item::create($data);
    }

    public function update(int $id, array $input)
    {
        Validator::make($input, [
            'file' => ['nullable', 'file', 'image', 'max:8192'],
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'string', 'min:0'],
            'category' => ['required', 'string', 'min:0'],
            'description' => ['string'],
        ])->validate();

        if ($input['file']) {
            $filename = uniqid('item_',true) . '.' . $input['file']->getClientOriginalExtension();

            $data = $input;
            $data['file'] = $filename;

            Storage::putFileAs('public/items', $input['file'], $filename);
        } else {
            unset($input['file']);
            $data = $input;
        }

        $data['updated_at'] = Carbon::now();

        $item = Item::findOrFail($id);
        $item->fill($data);

        $item->save();

        return $item;
    }

    public function destroy(int $id)
    {
        Item::destroy($id);
    }
}
