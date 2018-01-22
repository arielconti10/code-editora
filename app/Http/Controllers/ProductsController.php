<?php

namespace App\Http\Controllers;

use App\Criteria\FindByTitleCriteria;
use App\Criteria\FindByUserCriteria;
use App\Http\Requests\ProductCreateRequest;
use App\Entities\Product;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;
use ClassesWithParents\F;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $products = $this->repository->paginate(10);
        return view('products.index', compact('products', 'search'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('products.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso');
        return redirect()->to($url);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if(!($product)){
            throw new ModelNotFoundException('Product não foi encontrada');
        }
        if(Auth::user()->can('update', $product)) {
            return view('products.edit', compact('product'));
        } else {
            \Session::flash('error', 'Usuario nao autorizado');

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        if(!($product)){
            throw new ModelNotFoundException('Category não foi encontrada');
        }
        if(Auth::user()->can('update', $product)){
            $data = $request->except(['user_id']);
            $this->repository->update($data, $product->id);
            $request->session()->flash('message', 'Livro alterado com sucesso.');
            $url = $request->get('redirect_to', route('products.index'));
            return redirect()->to($url);
        } else {
            return redirect()->back()->with('error', 'Usuario nao autorizado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->repository->delete($product->id);
        \Session::flash('message', 'Livro excluído com sucesso');
        return redirect()->to(\URL::previous());
    }
}
