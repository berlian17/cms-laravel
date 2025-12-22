<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        $totalUsers = User::count();
        $totalActiveUsers = User::where('status', 1)->count();
        $totalInactiveUsers = User::where('status', 0)->count();

        if ($request->ajax()) {
            return view('pages.user.partials.table', compact('users'))->render();
        }

        return view('pages.user.index', compact(
            'users',
            'totalUsers',
            'totalActiveUsers',
            'totalInactiveUsers'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'add');
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'status'    => 1,
            ]);

            DB::commit();

            Log::info('Pengguna baru berhasil ditambahkan', [
                'id'            => $user->id,
                'created_at'    => now(),
                'created_by'    => Auth::user()->id,
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
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:6|confirmed',
            'status'    => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'edit');
        }

        if (($user->id === Auth::user()->id) && ($request->status == 0)) {
            return back()->with('error', 'Tidak bisa non aktifkan akun sendiri!');
        }

        DB::beginTransaction();

        try {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password ? bcrypt($request->password) : $user->password,
                'status'    => $request->status,
            ]);

            DB::commit();

            Log::info('Data pengguna berhasil diupdate', [
                'id'            => $user->id,
                'updated_at'    => now(),
                'updated_by'    => Auth::user()->id,
            ]);

            return back()->with('success', 'Data pengguna berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Gagal mengupdate data pengguna', [
                'error' => $th->getMessage(),
                'line'  => $th->getLine(),
                'file'  => $th->getFile(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
