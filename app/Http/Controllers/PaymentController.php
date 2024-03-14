<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Ticket;
use App\Notifications\sendTicketToUser;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\ReservationRepositoryInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class PaymentController extends Controller
{

    private $reservationRepository;
    private $eventRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository , EventRepositoryInterface $eventRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->eventRepository = $eventRepository;

    }
    public function preparePayment(Request $request)
    {

        $reservation =$this->reservationRepository->getById( $request->reservation_id);


        $payment = Mollie::api()->payments->create([
            'amount' => [
                'currency' => 'EUR',
                'value' =>  number_format($reservation->numberOfTicket *  $reservation->event->price, 2, '.', '') ,
            ],
            'description' => 'Payment for your event <<' . $reservation->event->name . '>> ticket',
            'redirectUrl' => route('payment.success'),
        ]);

        session()->put('paymentId', $payment->id);
        session()->put('reservation_id', $reservation->id);
        return redirect()->away($payment->getCheckoutUrl());
    }

    public function paymentSuccess(Request $request)
    {
        $paymentId = session()->get('paymentId');



        $payment = Mollie::api()->payments->get($paymentId);
        if($payment->isPaid())
        {
            $reservation_id = session()->get('reservation_id');
            $reservation = $this->reservationRepository->getById($reservation_id);


            $pymnt = new Payment;
            $pymnt->payment_id = $paymentId;
            $pymnt->description = $payment->description;
            $pymnt->amount = $payment->amount->value;
            $pymnt->currency = $payment->amount->currency;
            $pymnt->payment_status = "Completed";
            $pymnt->payment_method = "Mollie";
            $pymnt->reservation_id = $reservation_id;
            $pymnt->save();
            $reservation->itsPaid = 1;
            $reservation->save();

            $event =  $reservation->event;
            $event->rest_places -= $reservation->numberOfTicket;
            $event->save();
            for($i=0;$i<$reservation->numberOfTicket;$i++)  Ticket::create([
                'reservation_id' => $reservation_id
            ]);
            $user=auth()->user();








            $dompdf = new Dompdf();

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('fontDir', storage_path('fonts/'));
            $options->set('fontCache', storage_path('fonts/'));
            $dompdf->setOptions($options);

            $html = view('tickets.ticket', compact("reservation"))->render();
            $dompdf->loadHtml($html);

            $dompdf->render();

            $pdfFilename = 'ticket_' . uniqid() . '.pdf';
            $pdfPath = storage_path('app/public/tickets/' . $pdfFilename);
            $mypath ='tickets/' . $pdfFilename;
            file_put_contents($pdfPath, $dompdf->output());





            if (file_exists($pdfPath)) {

                $user = $reservation->user;
                $user->notify(new sendTicketToUser($reservation, $mypath));


                unlink($pdfPath);
            }


            session()->forget('paymentId');
            session()->forget('reservation_id');
            return redirect(route("profile.index"))->with('success', 'Your payment is done with success, check your email.');
        } else {
            return "error";
        }
    }


}
