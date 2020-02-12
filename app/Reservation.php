<?php

namespace App;

use App\Jobs\SendEmailJob;
use App\Place;
use App\Http\Requests\ReservationRequest;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    protected $table = 'reservations';
    protected $fillable = ['name', 'surname', 'email', 'start_date', 'place_id', 'id', 'end_date', 'time'];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function reservationRefused($start_date, $end_date, $place)
    {
        return (Reservation::where('place_id', $place)
            ->where([['start_date', '<=', $start_date], ['end_date', '>=', $end_date]])
            ->orWhere([['start_date', '>', $start_date], ['start_date', '<', $end_date]])
            ->orWhere([['end_date', '>', $start_date], ['end_date', '<', $end_date]])
            ->count());
    }

    public function sendMail($id)
    {
        dispatch(new SendEmailJob(Reservation::where('id', $id)->with('place')->first()));
    }
}
