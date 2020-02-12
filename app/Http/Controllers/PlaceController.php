<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Place;
use App\Reservation;
use Illuminate\Http\Request;
use PDF;

class PlaceController extends Controller
{
    //

    public function show()
    {
        $tasks = Place::all();
        return $tasks->toJson();
    }

    public function showPlace($id)
    {
        $task = Place::find($id);
        if ($task) {
            return json_encode($task->setRelation('reservations', $task->reservations()->paginate(5)));
        }
        return "Place not found";
    }
}
