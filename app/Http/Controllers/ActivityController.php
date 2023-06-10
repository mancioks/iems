<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $this->checkAdmin();
        $activities = Activity::query()->orderBy('id', 'desc')->paginate(100);

        return view('activity.index', compact('activities'));
    }
}
