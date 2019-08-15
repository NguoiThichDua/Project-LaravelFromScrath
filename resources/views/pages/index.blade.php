@extends('layouts.app')

@section('content')

    {{-- Tương đương --}}
    <!-- <h1><?php echo $title;?></h1> -->

    <div class="jumbotron text-center">
        <h1>{{ $title }}</h1>

        <p>This is the laravel from scratch</p>

        <div class="btn btn-success">Login</div>
        <div class="btn btn-danger">Sign up</div>
    </div>

    
@endsection

