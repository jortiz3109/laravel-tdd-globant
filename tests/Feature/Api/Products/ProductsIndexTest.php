<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductsIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_products(): void
    {
        $response = $this->getJson('/api/v1/products');

        $response->assertOk();
    }

    public function test_it_has_products_data(): void
    {
        Product::factory()->create();

        $response = $this->getJson('/api/v1/products');

        $response->assertJson(
            fn (AssertableJson $json) => $json->has('products', 1)
                ->has('products.0',
                    fn(AssertableJson $json) => $json->hasAll(['id', 'code', 'name', 'description'])
                )->etc()
        );
    }

    public function test_it_can_paginate_results(): void
    {
        Product::factory()->count(16)->create();

        $response = $this->getJson('/api/v1/products?page=2');

        $response->assertJson(
            fn (AssertableJson $json) => $json->has('products', 1)->etc()
        );
    }
}
