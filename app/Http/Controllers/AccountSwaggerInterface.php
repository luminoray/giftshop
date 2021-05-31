<?php


namespace App\Http\Controllers;


interface AccountSwaggerInterface
{
    /**
     * @OA\Post(
     *     tags={"Account"},
     *     path="/login",
     *     summary="Login",
     *     description="Log into a user",
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="User's email",
     *                  ),
     *                  @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="User's password",
     *                 )
     *             ),
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item added successfully",
     *     )
     * )
     *
     *
     */
    function loginStore();

    /**
     * @OA\Post(
     *     tags={"Account"},
     *     path="/register",
     *     summary="Register",
     *     description="Register a user",
     *     operationId="register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="User's display mail. This is not used for login.",
     *                  ),
     *                  @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="User's email. This is used for login.",
     *                  ),
     *                  @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="User's password",
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string",
     *                     description="Repeat user's password",
     *                 ),
     *             ),
     *          )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *     )
     * )
     *
     *
     */
    function registerStore();
}
