@extends('layouts.app')
@section('content')
<div class="dashboard">
    <div class="user-info">
        <h2>Bienvenido, {{ auth()->user()->name }}</h2>
        <p>Email: {{ auth()->user()->email }}</p>
        <p>Total reservaciones: {{ auth()->user()->reservations->count() }}</p>
    </div>

    <div class="reservations">
        <h3>Tus reservas activas</h3>
        <table class="reservation-table">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Fecha préstamo</th>
                    <th>Fecha entrega</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->book->title }}</td>
                        <td>{{ $reservation->start_date->format('Y-m-d') }}</td>
                        <td>{{ $reservation->end_date->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cancel-button">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection