<?php

namespace App;

use App\Reservation;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 

class Place extends Model
{
    protected $table = 'places';
    protected $fillable = ['id', 'address', 'size'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservationsByPlace($task)
    {
        return $task->setRelation('reservations', 
            $task->reservations()->
            where('end_date', '>=', Carbon::now('Europe/Vilnius'))->
            orderBy('start_date')->
            paginate(5));
    }

}

