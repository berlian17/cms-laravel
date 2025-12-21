<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\MediaTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Mews\Purifier\Facades\Purifier;

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

        if ($request->ajax()) {
            return view('pages.media.partials.table', compact('medias'))->render();
        }

        return view('pages.media.index', compact(
            'medias',
            'totalMedias',
            'totalActiveMedias',
            'totalInactiveMedias'
        ));
    }

    public function create()
    {
        $tags = Tag::orderBy('name')->get();

        return view('pages.media.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cover_img'     => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'title'         => 'required|string|max:255',
            'category'      => 'required|string|max:255',
            'excerpt'       => 'required|string|max:300',
            'description'   => 'nullable|string',
            'tags'          => 'nullable|array|max:10',
            'tags.*'        => 'required|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            // Cover
            if ($request->hasFile('cover_img')) {
                $filename = 'media_' . time() . '.webp';
                
                $image = Image::read($request->file('cover_img'))
                    ->scaleDown(width: 800)
                    ->toWebp(quality: 50);
                
                // Simpan
                Storage::disk('public')->put("media/$filename", (string) $image);
                
                $validated['cover_img'] = "/storage/media/$filename";
            } else {
                unset($validated['cover_img']);
            }

            $media = Media::create([
                'title'             => $validated['title'],
                'slug'              => Str::slug($validated['title']),
                'cover_img'         => $validated['cover_img'],
                'category'          => $validated['category'],
                'author'            => Auth::user()->name,
                'excerpt'           => $validated['excerpt'],
                'description'       => Purifier::clean($validated['description']), // Sanitasi HTML CKEditor
                'status'            => 1,
            ]);

            // Tags
            if (!empty($request->tags)) {
                $tagIds = [];

                foreach ($request->tags as $tag) {
                    if (is_numeric($tag)) {
                        $tagIds[] = (int) $tag;
                    } else {
                        $cleanName = trim($tag);

                        $tag = Tag::create([
                            'name' => ucfirst($cleanName),
                            'slug' => Str::slug($cleanName)
                        ]);

                        $tagIds[] = $tag->id;
                    }
                }

                foreach ($tagIds as $tagId) {
                    MediaTag::create([
                        'media_id'  => $media->id,
                        'tag_id'    => $tagId,
                    ]);
                }
            }

            DB::commit();

            Log::info('media berhasil ditambahkan', [
                'id'            => $media->id,
                'created_at'    => now(),
                'created_by'    => Auth::user()->id,
            ]);

            return redirect()->route('medias.index')
                ->with('success', 'Pmedia berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal menambahkan media', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function edit(Media $media)
    {
        $media->load('mediaTags', 'mediaTags.tag');
        $usedTagIds = $media->mediaTags
            ->pluck('tag_id')
            ->toArray();
        $tags = Tag::whereNotIn('id', $usedTagIds)
            ->orderBy('name')
            ->get();

        return view('pages.media.edit', compact(
            'media',
            'tags'
        ));
    }

    public function update(Request $request, Media $media)
    {
        $validated = $request->validate([
            'cover_img'     => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'title'         => 'required|string|max:255',
            'author'        => 'required|string|max:255',
            'category'      => 'required|string|max:255',
            'excerpt'       => 'required|string|max:300',
            'description'   => 'nullable|string',
            'status'        => 'required|in:0,1',
            'tags'          => 'nullable|array|max:10',
            'tags.*'        => 'required|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            // Cover
            if ($request->hasFile('cover_img')) {
                $filename = 'media_' . time() . '.webp';
                
                $image = Image::read($request->file('cover_img'))
                    ->scaleDown(width: 800)
                    ->toWebp(quality: 50);
                
                // Simpan
                Storage::disk('public')->put("media/$filename", (string) $image);
                
                $validated['cover_img'] = "/storage/media/$filename";
            } else {
                unset($validated['cover_img']);
            }

            $media->update([
                'title'             => $validated['title'],
                'slug'              => Str::slug($validated['title']),
                'cover_img'         => $validated['cover_img'] ?? $media->cover_img,
                'category'          => $validated['category'],
                'author'            => $validated['author'],
                'excerpt'           => $validated['excerpt'],
                'description'       => Purifier::clean($validated['description']), // Sanitasi HTML CKEditor
                'status'            => $validated['status'],
            ]);

            // Tags
            if (!empty($request->tags)) {
                $tagIds = [];

                foreach ($request->tags as $tag) {
                    if (is_numeric($tag)) {
                        $tagIds[] = (int) $tag;
                    } else {
                        $cleanName = trim($tag);

                        $tag = Tag::create([
                            'name' => ucfirst($cleanName),
                            'slug' => Str::slug($cleanName)
                        ]);

                        $tagIds[] = $tag->id;
                    }
                }

                foreach ($tagIds as $tagId) {
                    MediaTag::create([
                        'media_id'  => $media->id,
                        'tag_id'    => $tagId,
                    ]);
                }
            }

            DB::commit();

            Log::info('Data media berhasil diupdate', [
                'id'            => $media->id,
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->id,
            ]);

            return redirect()->route('medias.index')
                ->with('success', 'Data media berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal mengupdate data media', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function destroyTag(MediaTag $mediaTag)
    {
        try {
            DB::beginTransaction();

            $mediaTag->delete();

            DB::commit();
            
            Log::info('Tag berhasil dihapus dari media', [
                'id'            => $mediaTag->id,
                'deleted_at'    => now(),
                'deleted_by'    => Auth::user()->id,
            ]);

            return back()->with('success', 'Tag berhasil dihapus dari media');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal menghapus tag dari media', [
                'error'         => $th->getMessage(),
                'line'          => $th->getLine(),
                'file'          => $th->getFile(),
            ]);

            return back()->with('success', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
