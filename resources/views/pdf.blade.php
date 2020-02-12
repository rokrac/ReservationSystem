<!DOCTYPE html>
<html>
<head>
    <title>Reservation ticket</title>
    <link rel="stylesheet" src="{{asset('css/style.css')}}" type="text/css">
</head>
<style>
    * {
        box-sizing: border-box;
    }

    h1 {
        text-align: center;
    }

    strong {
        margin-top: 20px;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 50%;
        padding: 10px;

        text-align: center;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
<body>
<h1>Reservation System</h1>
<p>Hello, {{$reservation->name}}</p>
<p>You reservation is successful. There is are reminder and information of your reservation.</p>
<div class="row">
    <div class="column" style="background-color:#aaa;">
        <p>Full Name</p>
        <p>Start Date</p>
        <p>Finish Date</p>
        <p>Time</p>
        <p>Place</p>
        <p>Address</p>
        <p>Size</p>
    </div>
    <div class="column" style="background-color:#bbb;">
        <p>{{$reservation->name}} {{$reservation->surname}}</p>
        <p>{{$reservation->start_date}}</p>
        <p>{{$reservation->end_date}}</p>
        <p>{{$reservation->time}}</p>
        <p>{{$reservation->place->name}}</p>
        <p>{{$reservation->place->address}}</p>
        <p>{{$reservation->place->size}}</p>
    </div>
</div>
<strong>Thank you for using Reservation System.</strong>

</body>
</html>
