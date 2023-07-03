<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class ReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with('user', 'reservationable')->paginate(10);

        return view('dashboard.reservations.index', ['reservations' => $reservations]);
    }

    public function isPaid(Reservation $reservation)
    {
        $reservation->update([
            'is_paid' => $reservation->is_paid ? 0 : 1,
        ]);

        return redirect()->back()->with('success', 'Reservation updated successfully.');
    }

}
