<?php

namespace App\Http\Controllers;

use App\Lib\Services\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(Request $request)
    {
        $input = $request->only([
            'limit',
            'category',
            'ids'
        ]);

        return response()->json($this->itemService->get($input), 200);
    }

    public function show($id)
    {
        return response()->json($this->itemService->find($id), 200);
    }

    public function store(Request $request)
    {
        $input = $request->only([
            'file',
            'name',
            'price',
            'category',
            'description'
        ]);

        return response()->json($this->itemService->create($input), 201);
    }

    public function update(Request $request, $id)
    {
        $input = $request->only([
            'file',
            'name',
            'price',
            'category',
            'description'
        ]);

        return response()->json($this->itemService->update($id, $input), 200);
    }

    public function destroy($id)
    {
        $this->itemService->destroy($id);

        return response('', 200);
    }
}
