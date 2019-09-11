@extends('base')
@section('title')
    View Vacation | {{ $vacation->name }}
@overwrite
@section('content')
<br>
<div class="container">
    <!--Display session messages from redirects-->
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <br><br>

    <a href="/vacations"><p>< Back to all vacations</p></a>
    <div class="row" id="vacation-intro">
        <div class="card">
            <div class="card-body mb-3">
                <h1 class="display-3 card-title">{{ $vacation->name }}</h1>
                <p class="h4 card-text text-justify">{{ $vacation->description }}</p>    
            </div>
        </div>     
    </div>
    <br>

    <div class="row">
        <div id="vacation-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('/images/vacations/'.$vacation->name.'/slide1.jpg') }}" alt="">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('/images/vacations/'.$vacation->name.'/slide2.jpg') }}" alt="">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('/images/vacations/'.$vacation->name.'/slide3.jpg') }}" alt="">
            </div>
            <a class="carousel-control-prev" href="#vacation-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#vacation-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <br>
        <div class="card">
            <div class="card-body">
                <section id="vacation-reviews">
                <h1 class="card-title display-4">Reviews</h1>
                <br>
                <form method="get" action="/vacations/{{ $vacation->id }}/reviews/create">
                    <button class="btn btn-success" type="submit">Create Review</button>
                </form>

                @if ($vacation->reviews->count())
                    @foreach ($vacation->reviews as $review)
                        <div class="card review-card">
                            <div class="card-body">
                                <h3 class=" display-4 card-title">{{ $review->review_title }}</h3>
                                <i><h6 class="card-subtitle mb-2 text-muted">By: {{ $review->user->name }}</h6></i>
                                <i><h6 class="card-subtitle mb-2 text-muted">Created At: {{ $review->created_at }}</h6></i>
                                @if ($review->created_at != $review->updated_at)
                                        <h6 class="card-subtitle mb-2 text-muted">Updated At: {{ $review->updated_at }}</h6>
                                @endif
                                <br>      
                                <p class="h6 card-text">{{ $review->content }}</p>
                                <!--check if the logged-in user session matches the
                                    corresponding user_id foreign key on each review for authorization-->
                                @auth
                                    @if ($review->user_id === $logged_in_user->id)
                                    <div class="row">
                                            <form action="/vacations/reviews/{{ $review->id }}/edit" method="get">
                                            <button class="btn btn-info form-btn" type="submit">Edit</button>
                                        </form>
                                        <form action="/vacations/reviews/{{ $review->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-outline-danger form-btn" type="submit">Delete</button>
                                        </form>
                                    </div>
                                    @endif
                                @endauth
                            </div>     
                        </div>    
                    @endforeach
                @else
                    <div class="row">
                        <div class="col">
                            <br>
                            <div class="alert alert-info">
                                <p class="h4 text-justify text-center">There are no reviews yet. Why not add your own?</p>   
                            </div> 
                        </div>
                    </div>
                @endif

            </section>
        </div> 
    </div>
    <br>
    <a href="/vacations"><p>< Back to all vacations</p></a>
</div>
@endsection