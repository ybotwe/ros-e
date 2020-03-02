@extends('layouts.app')

@section('style')
<style>
    html, body {
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

    .links > a {
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
                    Mission
                </div>
                <div class="container  m-b-md">
                    <div class="row">
                        <p>
                        Ros-E aims to tackle the issue of lack of data driven and autonomous buildings and 
                        introduce the next generation of buildings. This is done by making an inexpensive
                         intelligent building automation system using Internet of Things technology to accumulate and
                          analyse the data of the surroundings of the building as well as its occupants.
                        </p>

                    </div>
                    
                </div>
            </div>
        </div>


@endsection