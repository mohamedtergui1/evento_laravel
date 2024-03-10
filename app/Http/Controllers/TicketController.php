<?php

namespace App\Http\Controllers;

use Spatie\LaravelPdf\Facades\Pdf;
use App\Models\Reservation;
use App\Models\Ticket;
use QrCode;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function generateTicket(Reservation $reservation)
{
    

 
   
            if (extension_loaded('imagick')) {
                echo 'Imagick extension is loaded.';
            } else {
                echo 'Imagick extension is not loaded.';
            }
            die;
    
    
        //    // Convert HTML to PDF
        //  $html = View::make('tickets.ticket')->render();

        // // Convert HTML to PDF and stream it to the browser
        // return Browsershot::html($html)
        // ->setOption('no-sandbox', true) // Add this option if you're facing issues in a production environment
        // ->setOption('print-media-type', true) // Enable print media type
        // ->pdf(); // Ge

    
    // create a new instance of Dompdf

    $dompdf = new Dompdf();
    
    $ticketInfo = [ 
        'name' => $reservation->user->name,
        'event' => $reservation->event->tittle ,
        'date' => \Carbon\Carbon::parse($reservation->event->date)->format('Y-F-d') ,
        'time' => \Carbon\Carbon::parse($reservation->event->date)->format('h:m') ,
        'location' => $reservation->event->location,
        'seat' => 'A12'
    ];
    
     
    $ticketInfoJson = json_encode($ticketInfo);
    $qrCodeImage = \QrCode::format('png')
                         ->size(200)  
                         ->errorCorrection('H')
                         ->generate($ticketInfoJson);
    
    // Encode the QR code image to base64
    $qrCodeBase64 = base64_encode($qrCodeImage);

    // load your HTML content with CSS styles
    $html = '
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ticket</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .ticket {
                border: 2px solid #333;
                padding: 20px;
                width: 300px;
            }
            .ticket h2 {
                margin: 0;
                font-size: 20px;
                text-align: center;
            }
            .ticket p {
                margin: 10px 0;
                font-size: 16px;
            }
            .ticket .details {
                border-top: 2px solid #333;
                padding-top: 10px;
                margin-top: 10px;
            }
            .ticket .details p {
                font-size: 14px;
            }
            .ticket .barcode {
                text-align: center;
                margin-top: 20px;
            }
            .barcode img {
                width: 200px;
                height: auto;
            }
        </style>
    </head>
    <body>
        <div class="ticket">
            <h2>Event Ticket</h2>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Event:</strong> Example Event</p>
            <p><strong>Date:</strong> January 1, 2025</p>
            <p><strong>Time:</strong> 7:00 PM</p>
            <div class="details">
                <p><strong>Location:</strong> Example Venue</p>
                <p><strong>Seat:</strong> A12</p>
            </div>
            <div class="barcode">
                <img src="data:image/png;base64,'. $qrCodeBase64 . '" alt="QR Code">
            </div>
        </div>
    </body>
    </html>
    ';
    
    $dompdf->loadHtml($html);

    // set the PDF rendering options
    $dompdf->setPaper('A4', 'portrait');

    // enable remote file access (e.g., to load external CSS files)
    $options = new Options();
    $options->set('isRemoteEnabled',true);
    $dompdf->setOptions($options);

    // render the PDF document
    $dompdf->render();

    // output the PDF document to the browser or save it to a file
    $dompdf->stream('document.pdf');
}

}
