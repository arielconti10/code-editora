@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Novo produto</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Subtitulo</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                {{ dd($errors) }}

                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->subtitle }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <ul>
                                <li>
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-link">Editar</a>
                                </li>
                                <li>
                                    <?php $deleteForm = "delete-form-{$loop->index}" ?>
                                    <a href="{{ route('products.destroy', ['product' => $product->id]) }}" class="btn btn-link"
                                        onclick="event.preventDefault(); document.getElementById('{{$deleteForm}}').submit()">Excluir</a>

                                    {!! Form::open(['route' => ['products.destroy', 'product' => $product->id] , 'class' => 'form', 'method' => 'DELETE', 'id' => "{$deleteForm}", 'style' => 'display:none']) !!}
                                    {!! Form::submit('Excluir', ['class' => 'btn btn-link']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $products->links() }}
        </div>
    </div>
@endsection