<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's dashboard with their active reservations.
     *
     * This method retrieves all active reservations for the currently authenticated user.
     * A reservation is considered active if its end date is today or in the future.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve the authenticated user's active reservations (where the end date is today or later)
        $reservations = Auth::user()->reservations()->where('end_date', '>=', now())->get();

        // Pass the reservations to the 'dashboard' view
        return view('dashboard', compact('reservations'));
    }
}
