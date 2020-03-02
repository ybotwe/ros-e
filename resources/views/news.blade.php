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
    li {
        list-style-type: none;
    }
    
</style>
<!-- Styles -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


@section('content')

        <div class="flex-center position-ref full-height">

            <div class="content" style="color:white;">
                <div class="title m-b-md">
                    News
                </div>
                <div class="container  m-b-md">
                    <div class="row">
                        <ul>
                            @foreach ($articles as $article)
                            <li>
                                <h3 >
                                    <a style="color:white" href="/news/{{ $article->id }}">{{ $article->title}}</a>
                                </h3>
                                <p>{{ $article->excerpt}}</p>

                            </li>
                            @endforeach

                        </ul>

                    </div>
                    
                </div>
            </div>
        </div>


@endsection