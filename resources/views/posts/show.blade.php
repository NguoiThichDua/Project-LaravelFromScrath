@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <small>Written on: {{ $post->created_at }}</small>
<hr>
    <div>
        <div>
            <img src="/LaravelFromScrath/public/storage/cover_images/{{ $post->cover_image }}" alt="" width="100%" >
        </div>
        {!! $post->body !!}
    </div>
    <div>

        <div class="row">
            <div class="col-md-6">
                <a href="/LaravelFromScrath/public/posts" class="btn btn-primary">Go back</a>
            </div>
            @if (!Auth::guest())
                @if (Auth::user()->id == $post->user_id)
                    <div class="col-md-6">
                        <div class="d-inline d-flex justify-content-end">
                            <a href="/LaravelFromScrath/public/posts/{{ $post->id }}/edit" class="btn btn-warning">Edit Post</a>
        
                            {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'd-inline ml-3'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                            {!!Form::close()!!}
                        </div>
                    </div>
                @endif
            @endif
            
        </div>

       

        
       
    </div>
<hr>
    <small>Updated on: {{ $post->updated_at }}</small>
@endsection