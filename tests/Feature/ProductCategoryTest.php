<?php

namespace Tests\Feature;

use App\Product;
use App\Category;
use Tests\TestCase;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::create(['name' => 'Trek Remedy 9.9 27.5']);
    }

    /**
     * @test
     */
    public function fetches_all_categories_indicating_association_with_product()
    {
        $categories = factory(Category::class, 7)->create();

        $this->product->categories()->attach([
            $categories[0]->id, $categories[1]->id
        ]);

        $this->assertCount(2, $this->product->categories);

        $this->assertTrue($this->product->has_categories);


        $response = $this->postJson(
            route('product.category.fetch', $this->product->id),
            ['needs_categories' => 1]
        );

        $response->assertStatus(Response::HTTP_OK);

        $expectation = $categories->sortBy('name')->map(function (Category $category) use ($categories) {
            return [
                'value' => $category->id,
                'name' => $category->name,
                'is_attached' => in_array($category->id, [$categories[0]->id, $categories[1]->id]),
            ];
        })->values();

        $response->assertExactJson($expectation->toArray());

        $this->assertTrue($this->product->fresh()->has_categories);
    }

    /**
     * @test
     */
    public function detaches_categories_and_returns_empty_array()
    {
        $categories = factory(Category::class, 7)->create();

        $this->product->categories()->attach([
            $categories[0]->id, $categories[1]->id
        ]);

        $this->assertCount(2, $this->product->categories);

        $this->assertTrue($this->product->has_categories);


        $response = $this->postJson(
            route('product.category.fetch', $this->product->id),
            ['needs_categories' => 0]
        );

        $response->assertStatus(Response::HTTP_OK);

        $response->assertExactJson([]);

        $product = $this->product->fresh('categories');

        $this->assertCount(0, $product->categories);

        $this->assertFalse($product->has_categories);
    }

    /**
     * @test
     */
    public function toggles_category_association()
    {
        $categories = factory(Category::class, 3)->create();

        $this->assertCount(0, $this->product->categories);


        $response = $this->postJson(
            route('product.category.toggle', $this->product->id),
            ['category_id' => $categories[0]->id]
        );

        $response->assertStatus(Response::HTTP_OK);

        $response->assertExactJson(['is_attached' => true]);

        $this->assertCount(1, $this->product->fresh('categories')->categories);


        $response = $this->postJson(
            route('product.category.toggle', $this->product->id),
            ['category_id' => $categories[0]->id]
        );

        $response->assertStatus(Response::HTTP_OK);

        $response->assertExactJson(['is_attached' => false]);

        $this->assertCount(0, $this->product->fresh('categories')->categories);
    }
}
