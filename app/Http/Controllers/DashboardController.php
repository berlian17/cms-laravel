<?php

namespace App\Http\Controllers;

use App\Models\ContactMail;
use App\Models\Media;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalMedias = Media::count();
        $totalServices = Service::count();
        $totalProjects = Project::count();
        $totalUsers = User::count();

        $mails = ContactMail::orderByRaw("FIELD(contact_mails.status, 'unread', 'read', 'replied', 'archived')")
            ->paginate(5)
            ->withQueryString();

        if ($request->ajax()) {
            return view('pages.dashboard.partials.table', compact('mails'))->render();
        }

        return view('pages.dashboard.index', compact(
            'totalMedias',
            'totalServices',
            'totalProjects',
            'totalUsers',
            'mails'
        ));
    }

    public function notification($id)
    {
        $contactMail = ContactMail::find($id);
        $appSetting = Setting::first();

        $contactMail->markAsRead();

        return view('pages.notification', compact(
            'contactMail',
            'appSetting'
        ));
    }
}
