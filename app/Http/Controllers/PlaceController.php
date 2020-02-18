<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Place;
use App\Reservation;
use Illuminate\Http\Request;


class PlaceController extends Controller
{
    public function __construct(Place $place)
    {
        $this->place = $place;
    }

    public function show()
    {
        $tasks = Place::all();
        return $tasks->toJson();
    }

    public function showPlace($id)
    {
        $task = Place::find($id);
        if ($task) {
            return json_encode($this->place->reservationsByPlace($task));
        }
        return "Place not found";
    }
}
