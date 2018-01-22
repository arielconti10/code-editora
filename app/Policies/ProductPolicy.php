<?php

namespace App\Policies;

use App\Entities\User;
use App\Entities\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Book  $product
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
     * @param  \App\Entities\Book  $product
     * @return mixed
     */
    public function update(User $user, Book $product)
    {
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Book  $product
     * @return mixed
     */
    public function delete(User $user, Book $product)
    {
        //
    }
}
