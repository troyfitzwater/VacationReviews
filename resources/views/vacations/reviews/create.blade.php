@extends('base')
@section('title', 'View Vacation')
@section('content')
<br>
<div class="container">
    
    <div class="row">
        <div class="col">
        <h1 class="page-header">Create a review for {{ $vacation->name }}</h1>
            <section id="review-form">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="/vacations/{{ $vacation->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="review_title">Title</label>
                        <input type="text" class="form-control" type="text" name="review_title" placeholder="Enter a title for your review" maxlength="50" required />
                    </div>
                    <div class="form-group">
                        <label for="content">Review</label>
                        <textarea name="content" class="form-control" placeholder="Write your review here" cols="30" rows="10" maxlength="350" required></textarea>
                    </div>
                    <input type="hidden" name="vacation_id" value="{{ $vacation->id }}" required />  
                    <input type="hidden" name="user_id" value="{{ $user->id }}" required />
                    <button class="btn btn-success form-btn" type="submit">Post Review</button>
                </form>
                <form action="/vacations/{{ $vacation->id }}" method="get">
                    <button class="btn btn-outline-primary form-btn" type="submit">Cancel</button>
                </form>
            </section>

        </div>
    </div>

</div>
@endsection