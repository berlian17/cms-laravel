<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('pages.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        DB::beginTransaction();

        try {
            User::create([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'password'  => $validated['password'],
                'status'    => 1,
            ]);

            DB::commit();

            Log::info('Pengguna baru berhasil ditambahkan', [
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->id,
            ]);

            return back()->with('success', 'Pengguna baru berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal menambahkan pengguna baru', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy(User $user)
    {
        $user->update(['status' => 0]);

        return back()->with('success', 'Data telah pengguna di non aktifkan');
    }
}
