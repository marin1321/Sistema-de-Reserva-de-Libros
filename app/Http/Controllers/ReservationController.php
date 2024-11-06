<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Cancel a reservation if the authenticated user is the reservation owner.
     *
     * This method checks if the logged-in user owns the specified reservation.
     * If the user is the owner, the reservation is deleted. Otherwise, the user
     * is redirected with an error message.
     *
     * @param Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Reservation $reservation)
    {
        // Ensure the authenticated user is the owner of the reservation
        if ($reservation->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->withErrors('You cannot cancel a reservation that is not yours.');
        }

        // Delete the reservation
        $reservation->delete();

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Reservation cancelled successfully!');
    }

    /**
     * Create a new reservation for a specified book.
     *
     * This method validates the user's input, ensuring that a valid book ID and a
     * reservation duration (in days) are provided. It then creates a reservation
     * with the start date set to the current date and the end date based on the
     * selected number of days.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the number of days for the reservation
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'days' => 'required|integer|min:1|max:30'
        ]);

        // Retrieve and set up reservation details
        $bookId = $request->input('book_id');
        $days = (int) $request->input('days');
        $start_date = Carbon::now();
        $endDate = Carbon::now()->addDays($days);

        // Create the reservation in the database
        Reservation::create([
            'user_id' => auth()->id(),
            'book_id' => $bookId,
            'start_date' => $start_date,
            'end_date' => $endDate,
        ]);

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Book reserved successfully!');
    }
}
