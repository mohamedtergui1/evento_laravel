<?php

namespace App\Http\Controllers;


use App\Models\Reservation;

use Dompdf\Dompdf;
use Dompdf\Options;

// use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function generateTicket(Reservation $reservation)
{

    $this->authorize('view', $reservation);
    $dompdf = new Dompdf();

    // Set options
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('fontDir', storage_path('fonts/'));
    $options->set('fontCache', storage_path('fonts/'));
    $dompdf->setOptions($options);


    $html = view('tickets.ticket' , compact("reservation"))->render();


    $dompdf->loadHtml($html);

    $dompdf->render();

    return $dompdf->stream('lotesStageFour.pdf');


}

}
