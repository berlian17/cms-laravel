<?php

namespace App\Http\Controllers;

use App\Models\IndustrialType;
use App\Models\Project;
use App\Models\ProjectGallery;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Mews\Purifier\Facades\Purifier;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $projects = Project::when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('service_name', 'like', "%{$search}%")
                    ->orWhere('industrial_type', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        $totalProjects = Project::count();
        $totalActiveProjects = Project::where('status', 1)->count();
        $totalInactiveProjects = Project::where('status', 0)->count();

        if ($request->ajax()) {
            return view('pages.project.partials.table', compact('projects'))->render();
        }

        return view('pages.project.index', compact(
            'projects',
            'totalProjects',
            'totalActiveProjects',
            'totalInactiveProjects'
        ));
    }

    public function create()
    {
        $services = Service::select('title')->get();
        $industrialTypes = IndustrialType::all();

        return view('pages.project.create', compact(
            'services',
            'industrialTypes'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cover_img'         => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'title'             => 'required|string|max:255',
            'client_name'       => 'required|string|max:255',
            'service_name'      => 'required|exists:services,title',
            'industrial_type'   => 'required|exists:industrial_types,name',
            'completion_date'   => 'required|date',
            'duration'          => 'required|numeric|min:1',
            'location'          => 'required|string|max:500',
            'description'       => 'nullable|string',
            'gallery_images'    => 'nullable|array',
            'gallery_images.*'  => 'image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Cover
            if ($request->hasFile('cover_img')) {
                $filename = 'project_' . time() . '.webp';
                
                $image = Image::read($request->file('cover_img'))
                    ->scaleDown(width: 800)
                    ->toWebp(quality: 50);
                
                // Simpan
                Storage::disk('public')->put("project/$filename", (string) $image);
                
                $validated['cover_img'] = "/storage/project/$filename";
            } else {
                unset($validated['cover_img']);
            }

            $project = Project::create([
                'industrial_type'   => $validated['industrial_type'],
                'title'             => $validated['title'],
                'slug'              => Str::slug($validated['title']),
                'cover_img'         => $validated['cover_img'],
                'service_name'      => $validated['service_name'],
                'completion_date'   => $validated['completion_date'],
                'description'       => Purifier::clean($validated['description']), // Sanitasi HTML CKEditor
                'client_name'       => $validated['client_name'],
                'location'          => $validated['location'],
                'duration'          => $validated['duration'],
                'status'            => 1,
            ]);

            // Gallery
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $gallery) {
                    $filename = 'gallery_' . $project->id . '_' . ($index + 1) . '_' . time() . '.webp';

                    $image = Image::read($gallery)
                        ->scaleDown(width: 800)
                        ->toWebp(quality: 50);

                    // Simpan
                    Storage::disk('public')->put("project/gallery/$filename", (string) $image);

                    ProjectGallery::create([
                        'project_id'    => $project->id,
                        'image'         => "/storage/project/gallery/$filename",
                    ]);
                }
            }

            DB::commit();

            Log::info('Portofolio berhasil ditambahkan', [
                'id'            => $project->id,
                'created_at'    => now(),
                'created_by'    => Auth::user()->id,
            ]);

            return redirect()->route('projects.index')
                ->with('success', 'Portofolio berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal menambahkan portofolio', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function edit(Project $project)
    {
        $project->load('galleries');
        $services = Service::select('title')->get();
        $industrialTypes = IndustrialType::all();

        return view('pages.project.edit', compact(
            'project',
            'services',
            'industrialTypes'
        ));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'cover_img'         => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'title'             => 'required|string|max:255',
            'client_name'       => 'required|string|max:255',
            'service_name'      => 'required|exists:services,title',
            'industrial_type'   => 'required|exists:industrial_types,name',
            'completion_date'   => 'required|date',
            'duration'          => 'required|numeric|min:1',
            'location'          => 'required|string|max:500',
            'description'       => 'nullable|string',
            'status'            => 'required|in:0,1',
            'gallery_images'    => 'nullable|array',
            'gallery_images.*'  => 'image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Cover
            if ($request->hasFile('cover_img')) {
                $filename = 'project_' . time() . '.webp';
                
                $image = Image::read($request->file('cover_img'))
                    ->scaleDown(width: 800)
                    ->toWebp(quality: 50);
                
                // Simpan
                Storage::disk('public')->put("project/$filename", (string) $image);
                
                $validated['cover_img'] = asset("storage/project/$filename");
            } else {
                unset($validated['cover_img']);
            }

            $project->update([
                'industrial_type'   => $validated['industrial_type'],
                'title'             => $validated['title'],
                'slug'              => Str::slug($validated['title']),
                'cover_img'         => $validated['cover_img'] ?? $project->cover_img,
                'service_name'      => $validated['service_name'],
                'completion_date'   => $validated['completion_date'],
                'description'       => Purifier::clean($validated['description']), // Sanitasi HTML CKEditor
                'client_name'       => $validated['client_name'],
                'location'          => $validated['location'],
                'duration'          => $validated['duration'],
                'status'            => $validated['status'],
            ]);

            // Gallery
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $gallery) {
                    $filename = 'gallery_' . $project->id . '_' . ($index + 1) . '_' . time() . '.webp';

                    $image = Image::read($gallery)
                        ->scaleDown(width: 800)
                        ->toWebp(quality: 50);

                    // Simpan
                    Storage::disk('public')->put("project/gallery/$filename", (string) $image);

                    ProjectGallery::create([
                        'project_id'    => $project->id,
                        'image'         => "/storage/project/gallery/$filename",
                    ]);
                }
            }

            DB::commit();

            Log::info('Data portofolio berhasil diupdate', [
                'id'            => $project->id,
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->id,
            ]);

            return redirect()->route('projects.index')
                ->with('success', 'Data portofolio berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal mengupdate data portofolio', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function destroyGallery(ProjectGallery $gallery)
    {
        try {
            DB::beginTransaction();

            $gallery->delete();

            DB::commit();
            
            Log::info('Gallery portofolio berhasil dihapus', [
                'id'            => $gallery->id,
                'deleted_at'    => now(),
                'deleted_by'    => Auth::user()->id,
            ]);

            return back()->with('success', 'Gallery portofolio berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal menghapus gallery portofolio', [
                'error'         => $th->getMessage(),
                'line'          => $th->getLine(),
                'file'          => $th->getFile(),
            ]);

            return back()->with('success', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
