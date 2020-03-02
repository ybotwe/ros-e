@extends('layouts.app')

@section('style')
<style>
    html,
    body {
        background-color: #2D2926;
        color: white;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links>a {
        color: white;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }


    .m-b-md {
        margin-bottom: 30px;
    }
</style>
<!-- Styles -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


@section('content')

<div class="flex-center position-ref full-height">

    <div class="content" style="color:white;">
        <div class="title m-b-md">
            About
        </div>
        <div class="container  m-b-md">
            <div class="row">
                <p>
                    Throughout time, the way in which buildings were constructed has changed drastically.
                    Early buildings were made out of more simple materials such as clay, stones, wood and
                    tree branches but through industrialization and the introduction of new and more durable
                    materials like iron, cement and concrete, buildings became taller and stronger.
                    The development of buildings did not stop there but grew with the introduction of technology.
                    Buildings now offer their occupants the option of controlling heating, humidity, ventilation,
                    air conditioning, lightning and security systems.
                    The next step for buildings is to make them more data driven and autonomous.
                </p>

                <p style="margin-top:10px;">
                    Ros-E is an intelligent building monitoring system that can be easily integrated into existing buildings to make these buildings smart.
                    She integrates all the core systems of the building such as fire alarms, power, lightning, heating, ventilation and air conditioning to be linked with each other.
                    This would give these systems the ability to talk to one another. Ros-E also consists of a number of sensors to detect and collect data ambient conditions in the building
                    like light intensity, motion, temperature, humidity and air quality. This data is then stored into a database and analyzed to make informed decisions.
                    The information analyzed by Ros-E is done in real time and the system makes automated adjustments to the conditions in the building where the need arises.
                    Ros-E also has a web platform to enable occupants to remotely turn on and off appliances and provide graphical status on the data gathered and analyzed by the system.
                </p>

            </div>

        </div>
    </div>
</div>


@endsection