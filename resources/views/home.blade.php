@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/LaravelFromScrath/public/posts/create" class="btn btn-primary">Create Post</a>
                   <h3>Your Blog Posts</h3>

                   @if (count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                        
                            @foreach ($posts as $post)
                                <tr>
                                    <th>{{ $post->title }}</th>
                                    <th> 
                                        <a href="/LaravelFromScrath/public/posts/{{ $post->id }}/edit" class="btn btn-warning">Edit Post</a>
                                    </th>
                                    <th>
                                        {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'd-inline ml-3'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </th>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        You have no posts
                    @endif
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
