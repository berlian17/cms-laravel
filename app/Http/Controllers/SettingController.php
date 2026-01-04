<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Throwable;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrFail();

        return view('pages.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name'      => 'required|string|max:255',
            'tagline'       => 'nullable|string|max:255',
            'description'   => 'nullable|string|max:300',
            'logo1'         => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'logo2'         => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'email'         => 'required|email',
            'phone'         => 'nullable|string|max:255',
            'whatsapp'      => 'nullable|string|max:255',
            'fax'           => 'nullable|string|max:255',
            'address'       => 'required|string|max:255',
            'linkedin'      => 'nullable|url',
            'facebook'      => 'nullable|url',
            'instagram'     => 'nullable|url',
            'twitter'       => 'nullable|url',
        ]);

        DB::beginTransaction();

        try {
            $setting = Setting::first();

            // Logo 1
            if ($request->hasFile('logo1')) {
                $filename = 'logo1_' . time() . '.webp';
                
                $image = Image::read($request->file('logo1'))
                    ->scaleDown(width: 800)
                    ->toWebp(quality: 50);
                
                // Simpan
                Storage::disk('public')->put("logo/$filename", (string) $image);
                
                $validated['logo1'] = "/storage/logo/$filename";
            } else {
                unset($validated['logo1']);
            }

            // Logo 2
            if ($request->hasFile('logo2')) {
                $filename = 'logo2_' . time() . '.webp';
                
                $image = Image::read($request->file('logo2'))
                    ->scaleDown(width: 800)
                    ->toWebp(quality: 50);
                
                // Simpan
                Storage::disk('public')->put("logo/$filename", (string) $image);
                
                $validated['logo2'] = "/storage/logo/$filename";
            } else {
                unset($validated['logo2']);
            }

            $setting->update($validated);

            DB::commit();

            Log::info('Pengaturan berhasil diupdate', [
                'id'            => $setting->id,
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->id,
            ]);

            return back()->with('success', 'Pengaturan berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal mengupdate pengaturan', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function downloadSitemap()
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'X-API-KEY' => config('services.sitemap.apikey'),
                ])
                ->get(config('services.sitemap.url'));

            if ($response->failed()) {
                Log::error('Gagal fetch sitemap', [
                    'status'    => $response->status(),
                    'body'      => $response->body(),
                ]);

                return back()->with('error', 'Gagal mengambil sitemap');
            }

            $xml = $response->body();
            if (empty($xml)) {
                return back()->with('error', 'Sitemap kosong');
            }

            Log::info('Sitemap berhasil diunduh', [
                'created_at'    => now(),
                'created_by'    => Auth::user()->id,
            ]);

            return response($xml, 200, [
                'Content-Type'          => 'application/xml',
                'Content-Disposition'   => 'attachment; filename="company-sitemap.xml"',
            ]);
        } catch (\Throwable $th) {
            Log::error('Gagal mengunduh sitemap', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan saat download sitemap');
        }
    }
}
