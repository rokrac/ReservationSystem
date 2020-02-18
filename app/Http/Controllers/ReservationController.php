<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Jobs\SendEmailJob;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;
use App\Helpers\DateHelper;

class ReservationController extends Controller
{

    public function __construct(Reservation $res)
    {
        $this->res = $res;
    }
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Reservation::all();
        return ReservationResource::collection($tasks)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json($request->validator->messages(), 422);
        }

        if ($this->res->reservationRefused(
                DateHelper::startDate($request->start_date),
                DateHelper::endDate($request->start_date, $request->time), 
                $request->place_id) != 0) {
            return response()->json(['reservationRefused' => 'Reservation exists on this time'], 422);
        };

        $reservation = new Reservation(array_merge($request->all(),
            ['end_date' => DateHelper::endDate($request->start_date, $request->time)]));
        $reservation->save();
        $this->res->sendMail($reservation->id);

        return new ReservationResource($reservation);
    }

}
