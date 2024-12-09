<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $query = User::query();
        // Handle search
        $search = $request->input('search');
        $query->where('name', 'like', "%$search%")
                ->orWhere('username', 'like', "%$search%");

        $users = $query->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedRequest = $request->validated();
        if (isset($validatedRequest['password'])) {
            $validatedRequest['password'] = Hash::make($validatedRequest['password']);
        } else {
            unset($validatedRequest['password']);
        }
        $user->update($validatedRequest);
        return redirect()->route('users.index')
                        ->with('success','Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                        ->with('success','Pengguna berhasil dihapus!');
    }
}
