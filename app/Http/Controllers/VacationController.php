<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacation;
use App\Models\Review;


class VacationController extends Controller
{
    public function index()
    {
        $vacations = Vacation::all();

        return view('vacations.index', ['vacations' => $vacations]);
    }

    public function show($id)
    {
        $vacation = Vacation::findOrFail($id);
        $reviews = DB::table('reviews')->where('vacation_id', $id)->get();
        $logged_in_user = auth()->user();

        return view('vacations.show', ['vacation' => $vacation, 'reviews' => $reviews, 'logged_in_user' => $logged_in_user]);
    }

    public function create()
    {
        return view('vacations.create');
    }
}
