<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product = $this->route('product');
        $id = $product ? $product->id : null;

        return [
            'title' => "required|max:255|unique:products,title,{$id}",
            'subtitle' => 'required',
            'price' => 'required'
        ];
    }
}
