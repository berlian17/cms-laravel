<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMedias = Media::count();
        $totalServices = Service::count();
        $totalProjects = Project::count();
        $totalUsers = User::count();

        return view('pages.dashboard', compact(
            'totalMedias',
            'totalServices',
            'totalProjects',
            'totalUsers'
        ));
    }
}
