<?php

namespace App;

use App\Reservation;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'places';
    protected $fillable = ['id', 'address', 'size'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}

