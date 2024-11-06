@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Confirma tu reserva</h3>
                    </div>
                    <div class="card-body">
                        <!-- Book Info -->
                        <div class="mb-4 card-body-box">
                            <h4>{{ $book->title }}</h4>
                            @if ($book->image_url)
                                <img src="{{ $book->image_url }}" alt="Book Image" class="img-fluid mb-3" />
                            @else
                                <p>No image available for this book.</p>
                            @endif
                            <p><strong>Author:</strong> {{ $book->author }}</p>
                            <p><strong>Description:</strong> {{ $book->description }}</p>
                        </div>

                        <!-- Reservation Form -->
                        <form action="{{ route('reservations.store') }}" method="POST" class="form-quantity">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            
                            <div class="form-group">
                                <label for="days">Number of days to reserve:</label>
                                <input type="number" id="days" name="days" class="form-control" min="1" max="30" style="border-radius: 1rem;" required>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success btn-lg">Confirmar Reserva</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary btn-lg">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
