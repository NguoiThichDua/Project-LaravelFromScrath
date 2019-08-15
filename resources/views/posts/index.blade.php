@extends('layouts.app')

@section('content')
    <h1>Post</h1>

    <a href="/LaravelFromScrath/public/posts/create" class="btn btn-primary mb-3">Create Post</a>

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <img src="/LaravelFromScrath/public/storage/cover_images/{{ $post->cover_image }}" alt="" width="100%" height="250px">
                        </div>
                        <div class="col-md-8">
                            <h3>
                                {{-- Đường dẫn tới hàm show của PostController --}}
                                <a href="./posts/{{ $post->id }}">{{ $post->title }}</a>
                            </h3>
                            <small>Written on: {{ $post->created_at }} <br> by <em>{{ $post->user->name }}</em></small>
                        </div>
                    </div>

                   
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    @else
        <div class="alert alert-secondary" role="alert">
            No Post Found
        </div>
    @endif
@endsection