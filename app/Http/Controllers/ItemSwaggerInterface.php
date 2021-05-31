<?php


namespace App\Http\Controllers;


interface ItemSwaggerInterface
{
    /**
     * @OA\Get(
     *     tags={"Items"},
     *     path="/api/items",
     *     summary="Get Items",
     *     description="Obtains a paginated list of items",
     *     operationId="indexItems",
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="Page number for pagination",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="limit",
     *          in="query",
     *          description="Number of items to return",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="category",
     *          in="query",
     *          description="Category of items to return",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="ids",
     *          in="query",
     *          description="An array of Ids of specific items you want to obtain",
     *          required=true,
     *          @OA\Schema(
     *              type="array",
     *              @OA\Items(
     *                  type="integer"
     *              ),
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A paginated list of items",
     *     ),
     * )
     *
     */
    function index();

    /**
     * @OA\Get(
     *     tags={"Items"},
     *     path="/api/items/{id}",
     *     summary="Get single Item data",
     *     description="Obtains the detailed data of an item",
     *     operationId="showItem",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of item to obtain data from",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The data of a single item",
     *     ),
     * )
     *
     */
    function show();

    /**
     * @OA\Post(
     *     tags={"Items"},
     *     path="/api/items",
     *     summary="Creates Item",
     *     description="Create a new item",
     *     operationId="createItem",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                     property="file",
     *                     type="file",
     *                     description="File",
     *                  ),
     *                  @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Item name",
     *                 ),@OA\Property(
     *                     property="price",
     *                     description="Item's price",
     *                     type="float",
     *                 ),@OA\Property(
     *                     property="category",
     *                     description="Item category",
     *                     type="integer",
     *                 ),@OA\Property(
     *                     property="description",
     *                     description="Item description",
     *                     type="string",
     *                 )
     *             ),
     *          )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Item added successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Item not created"
     *     ),
     * )
     *
     *
     */
    function store();

    /**
     * @OA\Put(
     *     tags={"Items"},
     *     path="/api/items/{id}",
     *     summary="Updates Item",
     *     description="Update an existing item",
     *     operationId="updateItem",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of item to update",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                     property="file",
     *                     type="file",
     *                     description="File",
     *                  ),
     *                  @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Item name",
     *                 ),@OA\Property(
     *                     property="price",
     *                     description="Item's price",
     *                     type="float",
     *                 ),@OA\Property(
     *                     property="category",
     *                     description="Item category",
     *                     type="integer",
     *                 ),@OA\Property(
     *                     property="description",
     *                     description="Item description",
     *                     type="string",
     *                 )
     *             ),
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item updated successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Item not updated"
     *     ),
     * )
     *
     *
     */
    function update();

    /**
     * @OA\Delete(
     *     tags={"Items"},
     *     path="/api/items/{id}",
     *     summary="Deletes Item",
     *     description="Delete an item",
     *     operationId="deleteItem",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of item to be deleted",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item deleted successfully",
     *     ),
     * )
     *
     *
     */
    function destroy();
}
