@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Novo produto</h3>

            {!! Form::open(['route' => 'products.store', 'class' => 'form']) !!}

                {!! Html::openFormGroup('title', $errors) !!}
                    {!! Form::label('title', 'Titulo') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    {!! Form::error('title', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('subtitle', $errors) !!}
                    {!! Form::label('subtitle', 'Subtitulo') !!}
                    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
                    {!! Form::error('subtitle', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup('price', $errors) !!}
                    {!! Form::label('price', 'Preço', ['class' => 'control-label']) !!}
                    {!! Form::number('price', null, ['class' => 'form-control']) !!}
                    {!! Form::error('price', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup() !!}
                    {!! Button::primary('Criar produto')->submit() !!}
                {!! Html::closeFormGroup() !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection