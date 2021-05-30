<?php

namespace App\Lib\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemService
{
    public function get()
    {
        return Item::paginate(10);
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
}
