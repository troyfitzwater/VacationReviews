@extends('base')
@section('title', 'Edit a Joke')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Editing: "{{ $review->review_title }}"</h1>

            <section>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="post" action="/vacations/reviews/{{ $review->id }}">
                    <!--Create a hidden input with the value "patch, 
                        telling Laravel that this needs to update the binded review-->
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="review_title">Title</label>
                        <input type="text" class="form-control" name="review_title" value="{{ $review->review_title }}" required />
                    </div>
                    <div class="form-group">
                        <label for="content">Review</label>
                        <textarea name="content" class="form-control" cols="30" rows="10" required>{{ $review->content }}</textarea>
                    </div>
                    <input type="hidden" name="vacation_id" value="{{ $review->vacation_id }}" required />  
                    <input type="hidden" name="user_id" value="{{ $review->user_id }}" required />
                    <button class="btn btn-info" type="submit">Update</button>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection