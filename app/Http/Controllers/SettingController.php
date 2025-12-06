<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Throwable;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::firstOrFail();

        return view('pages.setting', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name'      => 'required|string',
            'tagline'       => 'nullable|string',
            'logo'          => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'email'         => 'required|email',
            'phone'         => 'nullable|string',
            'whatsapp'      => 'nullable|string',
            'fax'           => 'nullable|string',
            'address'       => 'required|string',
            'company_name'  => 'required|string',
            'short_desc'    => 'required|string',
            'long_desc'     => 'required|string',
            'linkedin'      => 'nullable|url',
            'facebook'      => 'nullable|url',
            'instagram'     => 'nullable|url',
            'twitter'       => 'nullable|url',
        ]);

        DB::beginTransaction();

        try {            
            $settings = Setting::first();

            if ($request->hasFile('logo')) {
                $filename = 'logo_' . time() . '.webp';
                
                $image = Image::read($request->file('logo'))
                    ->scaleDown(width: 800)
                    ->toWebp(quality: 50);
                
                // Simpan
                Storage::disk('public')->put("logo/$filename", (string) $image);
                
                $validated['logo'] = $filename;
            } else {
                unset($validated['logo']);
            }

            $settings->update($validated);

            DB::commit();

            Log::info('Pengaturan berhasil diupdate', [
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->id,
            ]);

            return back()->with('success', 'Perubahan berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal update Pengaturan', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
