<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index()
    {
        return Entry::all()->toJson();
    }
}
