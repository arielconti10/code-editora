@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de Categorias</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Nova categoria</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <ul>
                                <li>
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-link">Editar</a>
                                </li>
                                <li>
                                    <?php $deleteForm = "delete-form-{$loop->index}" ?>
                                    <a href="{{ route('categories.destroy', ['category' => $category->id]) }}" class="btn btn-link"
                                        onclick="event.preventDefault(); document.getElementById('{{$deleteForm}}').submit()">Excluir</a>

                                    {!! Form::open(['route' => ['categories.destroy', 'category' => $category->id] , 'class' => 'form', 'method' => 'DELETE', 'id' => "{$deleteForm}", 'style' => 'display:none']) !!}
                                    {!! Form::submit('Excluir', ['class' => 'btn btn-link']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $categories->links() }}
        </div>
    </div>
@endsection