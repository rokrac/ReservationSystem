<!DOCTYPE html>
<html>
<head>
    <title>Reservation email</title>
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
    <div class="column">
        <p><strong>Full Name:</strong>{{$reservation->name}} {{$reservation->surname}}</p>
        <p><strong>Start Date:</strong>{{$reservation->start_date}}</p>
        <p><strong>Finish Date:</strong>{{$reservation->end_date}}</p>
        <p><strong>Time:</strong>{{$reservation->time}}h</p>
        <p><strong>Place:</strong>{{$reservation->place->name}}</p>
        <p><strong>Address:</strong>{{$reservation->place->address}}</p>
        <p><strong>Size:</strong>{{$reservation->place->size}}</p>
    </div>


    <strong>Thank you for using Reservation System.</strong>

</body>
</html>
