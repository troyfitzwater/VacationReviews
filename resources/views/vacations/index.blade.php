@extends('base')
@section('title', 'Vacations')
@section('content')
<br>
<div class="container">

    <div class="h-100 p-4 jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Vacation Station</h1>
            <p class="lead">Where to next?</p>
            <form action="/login" method="get">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </div>
    <br>
    <?php
        $maxColumns = 3;
        $numOfRows = 0;
        $columnWidth = 12 / $maxColumns;
    ?>
    <div class="row">
        @foreach ($vacations as $vacation)
            <div class="col-md-<?php echo $columnWidth; ?>">
                <div class="card mb-3">
                    <img class="card-img-top" src="{{ asset('/images/vacations/'.$vacation->name.'/thumbnail.jpg') }}">
                    <div class="card-body">
                        <h3 class="card-title">{{ $vacation->name }}</h5>
                        <p class="card-text">{{ $vacation->location }}</p>
                        <form method="get" action="/vacations/{{ $vacation->id }}">
                            <button class="btn btn-main" type="submit">More info</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--<div class="col">
                <img src="{{ asset('/images/vacations/'.$vacation->name.'/preview.jpg') }}" alt="{{ $vacation->name }}" class="fluid-img" height="150">
            </div>-->
            <?php
                $numOfRows++;
                if($numOfRows % $maxColumns == 0) echo '</div><div class="row">';
            ?>
        @endforeach
    </div>
</div>
@endsection