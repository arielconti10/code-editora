<?php

namespace App\Http\Requests;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductUpdateRequest extends ProductCreateRequest
{
     private $repository;

     public function __construct(ProductRepository $repository)
     {
         $this->repository = $repository;
     }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $book = $this->route('product');

        if($book->id == 0){
            return false;
        }

        return $book->user_id == \Auth::user()->id;
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
            'title' => "required|max:255",
            'subtitle' => 'required|max:255',
            'price' => 'required|numeric'
        ];
    }
}
