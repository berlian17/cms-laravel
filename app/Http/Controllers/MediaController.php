<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $medias = Media::when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        $totalMedias = Media::count();
        $totalActiveMedias = Media::where('status', 1)->count();
        $totalInactiveMedias = Media::where('status', 0)->count();

        return view('pages.media.index', compact(
            'medias',
            'totalMedias',
            'totalActiveMedias',
            'totalInactiveMedias'
        ));
    }

    public function create()
    {
        return view('pages.media.create');
    }

    public function store(Request $request)
    {

    }

    public function edit()
    {
        return view('pages.media.edit');
    }

    public function update(Request $request)
    {

    }
}
