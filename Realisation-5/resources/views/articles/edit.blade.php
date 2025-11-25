@extends('layouts.admin')

@section('content')
    @include('articles.form', ['article' => $article])
@endsection
