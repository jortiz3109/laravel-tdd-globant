<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductController extends Controller
{
    public function index(): ResourceCollection
    {
        $products = Product::select(['id', 'code', 'name', 'description'])->paginate();

        return new ProductCollection($products);
    }
}
