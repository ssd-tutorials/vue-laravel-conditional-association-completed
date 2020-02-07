<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ToggleRequest
 *
 * @package App\Http\Requests\Category
 *
 * @property int $category_id
 */
class ToggleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:categories,id'
            ],
        ];
    }

    /**
     * Attach / detach category.
     *
     * @return bool
     */
    public function toggle(): bool
    {
        return (bool)$this->route('product_id')
            ->categories()
            ->toggle($this->category_id)['attached'];
    }
}
