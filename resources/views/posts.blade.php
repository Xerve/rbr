@extends('app')

@section('header_script')

<style type="text/css">
    table {
        width:100%;
    }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
        padding:5px;
    }
</style>

@endsection

@section('content')

<div class="p-6">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tytuł</th>
                <th scope="col">Zajawka</th>
                <th scope="col">Autor</th>
                <th scope="col">Akcja</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ Str::limit($post->body, 100) }}</td>
            <td>{{ $post->author->name }}</td>
            <td><a href="{{ route('posts.show', ['id' => $post->id]) }}">Pokaż szczegóły</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>


@endsection
