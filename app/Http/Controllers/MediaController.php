<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function index()
    {
        return view('pages.media.index');
    }

    public function store(Request $request)
    {

    }

    public function edit()
    {

    }

    public function update(Request $request)
    {

    }

    public function destroy()
    {
        
    }
}
