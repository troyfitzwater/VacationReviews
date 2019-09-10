<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vacation;
use App\Models\Review;
use Auth;

class ReviewController extends Controller
{
    public function create($id)
    {
        $vacation = Vacation::findOrFail($id);
        $user = Auth::user();

        return view('/vacations.createReview', ['vacation' => $vacation, 'user' => $user]);
    }

    public function store(Request $request)
    {     
        // Set validation rules
        $validateData = $request->validate([
            'review_title' => 'bail|required|unique:reviews,review_title|max:100',
            'content' => 'bail|required|max:350',
            'vacation_id' => 'bail|required|exists:vacations,id',
            'user_id' => 'bail|required|exists:users,id',
        ]);

        $review = new Review();

        $review->review_title = request('review_title');
        $review->content = request('content');
        $review->vacation_id = request('vacation_id');
        $review->user_id = request('user_id');

        $review->save();

        $vacation = Vacation::findOrFail($review->vacation_id);
        $reviews = DB::table('reviews')->where('vacation_id', $review->vacation_id)->get();

        return redirect()->route('show_vacation', [$vacation])
        ->with('message', 'Review successfully submitted');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        return view('/vacations.reviews.edit', ['review' => $review]);
    }

    public function update($id, Request $request)
    {
        $review = Review::findOrFail($id);
        $vacation = Vacation::findOrFail($review->vacation_id);

        // Consistent validation rules with creating a review
        $validateData = $request->validate([
            // Force the title to be unique unless the id matches the corresponding entry in the database with the same name
            'review_title' => 'bail|required|unique:reviews,review_title'. ($id ? ",$id" : '') .'|max:100',
            'content' => 'bail|required|max:350',
            'vacation_id' => 'bail|required|exists:vacations,id',
            'user_id' => 'bail|required|exists:users,id',
        ]);
        
        $review->review_title = request('review_title');
        $review->content = request('content');
        $review->vacation_id = request('vacation_id');
        $review->user_id = request('user_id');

        $review->save();

        return redirect()->route('show_vacation', [$vacation])
        ->with('message', 'Review successfully updated');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $vacation = Vacation::findOrFail($review->vacation_id);

        Review::findOrFail($id)->delete();

        return redirect()->route('show_vacation', [$vacation])
        ->with('message', 'Review successfully deleted');
    }
}
