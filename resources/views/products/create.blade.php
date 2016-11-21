@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo produto</h3>

            {!! Form::open(['route' => 'products.store', 'class' => 'form']) !!}

            <div class="form-group">
                {!! Form::label('title', 'Titulo') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('subtitle', 'Subtitulo') !!}
                {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price', 'Preço') !!}
                {!! Form::number('price', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Criar produto', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
@endsection