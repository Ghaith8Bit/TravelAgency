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

        $message = app()->getLocale() === 'ar' ? 'تم تحديث الحجز بنجاح.' : 'Reservation updated successfully.';
        return redirect()->back()->with('success', $message);

    }

    public function myReservations()
    {
        $user = auth()->user();
        $reservations = Reservation::where('user_id', $user->id)->paginate(10);

        return view('dashboard.reservations.my', ['reservations' => $reservations]);
    }

}
