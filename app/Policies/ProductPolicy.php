<?php

namespace App\Policies;

use App\Entities\User;
use CodeEduBook\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Entities\User  $user
     * @param  \CodeEduBook\Models\Book  $product
     * @return mixed
     */
    public function view(User $user, Book $product)
    {
        //
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\Entities\User  $user
     * @param  \CodeEduBook\Models\Book  $product
     * @return mixed
     */
    public function update(User $user, Book $book)
    {
        return $user->id === $book->author_id;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\Entities\User  $user
     * @param  \CodeEduBook\Models\Book  $product
     * @return mixed
     */
    public function delete(User $user, Book $product)
    {
        //
    }
}
