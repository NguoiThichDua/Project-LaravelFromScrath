@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    {!! Form::open(['method' => 'POST', 'action' => 'PostController@store','enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{-- type:text - name:title - value:'' --}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{-- type:textarea - name:body - value:'' --}}
            {{Form::textarea('body','',['id' => '','class'=>'form-control ckeditor', 'placeholder' => 'Body'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
    {!! Form::close() !!}
@endsection