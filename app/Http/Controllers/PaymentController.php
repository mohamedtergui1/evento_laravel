<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\ReservationRepositoryInterface;
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


            session()->forget('paymentId');
            session()->forget('reservation_id');
            return redirect(route("profile.index"))->with("success", "Your payment is done with success");
        } else {
            return "canceled";
        }
    }


}
