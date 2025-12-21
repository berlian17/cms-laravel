<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $services = Service::when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        $totalServices = Service::count();
        $totalActiveServices = Service::where('status', 1)->count();
        $totalInactiveServices = Service::where('status', 0)->count();

        if ($request->ajax()) {
            return view('pages.service.partials.table', compact('services'))->render();
        }

        return view('pages.service.index', compact(
            'services',
            'totalServices',
            'totalActiveServices',
            'totalInactiveServices'
        ));
    }

    public function create()
    {
        return view('pages.service.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'icon'          => 'required|string|max:50',
            'short_desc'    => 'required|string|max:300',
            'long_desc'     => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {            
            $service = Service::create([
                'title'         => $validated['title'],
                'slug'          => Str::slug($validated['title']),
                'icon'          => $validated['icon'],
                'short_desc'    => $validated['short_desc'],
                'long_desc'     => Purifier::clean($validated['long_desc']), // Sanitasi HTML CKEditor
                'status'        => 1,
            ]);

            DB::commit();

            Log::info('Layanan berhasil ditambahkan', [
                'id'            => $service->id,
                'created_at'    => now(),
                'created_by'    => Auth::user()->id,
            ]);

            return redirect()->route('services.index')
                ->with('success', 'Layanan berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal menambahkan layanan', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function edit(Service $service)
    {
        return view('pages.service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'icon'          => 'required|string|max:50',
            'short_desc'    => 'required|string|max:300',
            'long_desc'     => 'nullable|string',
            'status'        => 'required|in:0,1',
        ]);

        DB::beginTransaction();

        try {            
            $service->update([
                'title'         => $validated['title'],
                'slug'          => Str::slug($validated['title']),
                'icon'          => $validated['icon'],
                'short_desc'    => $validated['short_desc'],
                'long_desc'     => Purifier::clean($validated['long_desc']), // Sanitasi HTML CKEditor
                'status'        => $validated['status'],
            ]);

            DB::commit();

            Log::info('Data layanan berhasil diupdate', [
                'id'            => $service->id,
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->id,
            ]);

            return redirect()->route('services.index')
                ->with('success', 'Data layanan berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal mengupdate data layanan', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
