@extends('layouts.app')
@section('content')
<div class="book-listing">
    <h2>Libros Disponibles</h2>
    <form class="filter" id="filterForm">
        <label for="category">Filtrar por categoría:</label>
        <select id="category" name="category" onchange="filterBooks()">
            <option value="" selected disabled>----------</option>
            <option value="All Categories">All Categories</option>
            @foreach ($categories as $categorySelect)
                <option value="{{ $categorySelect->name }}">{{ $categorySelect->name }}</option>
            @endforeach
        </select>
    </form>
    <h3 style="font-size: 1.5rem; margin: 1rem">{{$category}}</h3>
    <div class="books">
        @foreach($availableBooks as $book)
            <div class="book-card">
                <img src="{{ $book->image_url }}" alt="{{ $book->title }}">
                <h3>{{ $book->title }}</h3>
                <p>{{ $book->author }}</p>
                <a class="reserve-button" href="{{ route('books.reserve', $book) }}" class="btn btn-primary">Reservar</a>
            </div>
        @endforeach
    </div>
</div>
<script>
    function filterBooks() {
        document.getElementById('filterForm').submit();
    }
</script>
@endsection