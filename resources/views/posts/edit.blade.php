@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>

{!! Form::open(['method' => 'POST','enctype' => 'multipart/form-data', 'action' => ['PostController@update', $post->id]]) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{-- type:text - name:title - value:'' --}}
        {{Form::text('title',$post->title,['class'=>'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{-- type:textarea - name:body - value:'' --}}
        {{Form::textarea('body',$post->body,['id' => '','class'=>'form-control ckeditor', 'placeholder' => 'Body'])}}
    </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
{!! Form::close() !!}
@endsection