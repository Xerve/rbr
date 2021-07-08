@extends('app')

@section('header_script')

<style type="text/css">
    section {
        padding:20px;
    }
</style>

@endsection


@section('content')
<section>
    <article>
        <header>
            <h1>{{ $post->title }}</h1>
        </header>
    
        {!! $post->title !!}

    </article>
    @if($post->author)
    <div class="author-info">
        <h2>Dane autora</h2>    
        <p>Imię i nazwisko: {{ $post->author->name }}</p>    
        <p>Login: {{ $post->author->username }}</p>
        <p>Adres e-mail: {{ $post->author->email }}</p>
        <p>Telefon: {{ $post->author->phone }}</p>
        <p>Strona www: {{ $post->author->website }}</p>

        @if($post->author->address)
            <h3>Adres autora</h3>
            <p>Ulica: {{ $post->author->address->street }} {{ $post->author->address->suite }}</p>
            <p>Kod pocztowy i miasto: {{ $post->author->address->zipcode }} {{ $post->author->address->city }}</p>
            <p>Współrzędne: {{ $post->author->address->geo_lat }} {{ $post->author->address->geo_lng }}</p>
        @endif

        @if($post->author->company)
            <h3>Miejsce pracy</h3>
            <p>Nazwa firmy: {{ $post->author->company->name }}</p>
            <p>Slogan: {{ $post->author->company->catch_phrase }}</p>
            <p>BS: {{ $post->author->company->bs }}</p>
        @endif

    </div>
    @endif

    <a href="{{ route('posts.index') }}">Powrót do listy</a>
</section>

@endsection
