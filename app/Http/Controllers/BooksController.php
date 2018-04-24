<?php

namespace App\Http\Controllers;

use App\Criteria\FindByTitleCriteria;
use App\Criteria\FindByUserCriteria;
use App\Http\Requests\bookCreateRequest;
use App\Entities\Book;
use App\Http\Requests\bookUpdateRequest;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use ClassesWithParents\F;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    private $repository;
    private $categoryRepository;

    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->paginate(10);
        return view('books.index', compact('books', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->pluck('name', 'id');
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('books.index'));
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
    public function edit(Book $book)
    {
        if(!($book)){
            throw new ModelNotFoundException('book não foi encontrada');
        }
        if(Auth::user()->can('update', $book)) {
            $this->categoryRepository->withTrashed();
            $categories = $this->categoryRepository->pluckWithMutators('name_trashed', 'id');

            return view('books.edit', compact('book', 'categories'));
        } else {
            \Session::flash('error', 'Usuario nao autorizado');

            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        if(!($book)){
            throw new ModelNotFoundException('Category não foi encontrada');
        }
        if(Auth::user()->can('update', $book)){
            $data = $request->except(['author_id']);
            $this->repository->update($data, $book->id);
            $request->session()->flash('message', 'Livro alterado com sucesso.');
            $url = $request->get('redirect_to', route('books.index'));
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
    public function destroy(Book $book)
    {
        $this->repository->delete($book->id);
        \Session::flash('message', 'Livro excluído com sucesso');
        return redirect()->to(\URL::previous());
    }
}