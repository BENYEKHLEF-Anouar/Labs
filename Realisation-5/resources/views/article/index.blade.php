@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Liste des articles</h1>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Titre</th>
                <th class="py-2 px-4 border-b">Auteur</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td class="py-2 px-4 border-b">{{ $article->id }}</td>
                <td class="py-2 px-4 border-b">{{ $article->title }}</td>
                <td class="py-2 px-4 border-b">{{ $article->author->name ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('article.edit', $article->id) }}" class="text-blue-600 hover:underline">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
