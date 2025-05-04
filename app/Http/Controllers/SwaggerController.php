<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * @OA\Info(
 *     title="Car Sharing API",
 *     version="1.0.0",
 *     description="API для управления каршерингом",
 *     @OA\Contact(email="support@carsharing.com")
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Основной сервер API"
 * )
 *
 * @OA\Tag(
 *     name="Vehicles",
 *     description="Операции с транспортными средствами"
 * )
 *
 * @OA\Tag(
 *     name="Rentals",
 *     description="Управление арендами"
 * )
 *
 *
 * @OA\PathItem(
 *     path="/"
 * )
 */
class SwaggerController extends Controller
{
    //
}
