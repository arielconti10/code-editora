<?php

namespace App\Http\Requests;

use App\Entities\Book;
use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
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
        $book = $this->route('book');
        $id = $book ? $book->id : null;

        return [
            'title' => "required|max:255",
            'subtitle' => 'required|max:255',
            'price' => 'required|numeric'
        ];
    }
}
