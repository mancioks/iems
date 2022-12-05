<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->input('search', '');

        $entries = Entry::query()
            ->with('translations')
            ->orderBy('id', 'desc')
            ->where('value', 'like', '%' . $search . '%')
            ->orWhereHas('translations', function ($query) use ($search) {
                $query->where('translation', 'like', '%' . $search . '%');
            })
            ->orWhere('id', $search)
            ->paginate(10);

        $types = Entry::TYPES;

        return view('home', compact('entries', 'types'));
    }
}
