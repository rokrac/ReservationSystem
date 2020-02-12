<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Reservation;

class PdfController extends Controller
{

    public function downloadPDF($id)
    {
        $reservation = Reservation::where('id', $id)->with('place')->first();
        $pdf = PDF::loadView('pdf', compact('reservation'));
        return $pdf->download('ReservationTicket-' . $id . '.pdf');
    }


}
