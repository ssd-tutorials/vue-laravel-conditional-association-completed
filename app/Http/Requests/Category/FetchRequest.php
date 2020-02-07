<?php

namespace App\Http\Requests\Category;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

/**
 * Class FetchRequest
 *
 * @package App\Http\Requests\Category
 *
 * @property int $needs_categories
 */
class FetchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'needs_categories' => [
                'required',
                'in:0,1',
            ],
        ];
    }

    /**
     * Get response data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function responseData(): Collection
    {
        $product = $this->route('product_id');

        if (!$this->needs_categories) {
            $product->categories()->detach();

            return new Collection;
        }

        return Category::orderBy('name')->get()->map(function (Category $category) use ($product) {
            return [
                'value' => $category->id,
                'name' => $category->name,
                'is_attached' => $product->categories->contains('id', $category->id),
            ];
        });
    }
}
