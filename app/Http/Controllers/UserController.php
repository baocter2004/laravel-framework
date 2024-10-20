<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest('id')->paginate(10);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('images', $request->file('image'));
            }

            User::query()->create($data);

            return redirect()
                ->route('users.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->except('image');

            // $data['is_active'] = $request->filled('is_active') ? 1 : 0;

            $oldImage = $user->image;

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('images', $request->file('image'));
            }

            $user->update($data);

            if ($request->hasFile('image') && !empty($oldImage) && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }

            return redirect()
                ->route('users.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return redirect()
                ->route('users.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false);
        }
    }

    // show Users đã vào thùng rác

    public function trash()
    {
        $users = User::onlyTrashed()->latest('id')->paginate(5);

        return view('users.trash', ['users' => $users]);
    }

    // xóa cứng

    public function forceDestroy($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);

            $user->forceDelete();

            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            return redirect()->route('users.trash')->with('success', 'User permanently deleted.');
        } catch (\Throwable $th) {
            return back()->with('error', 'User not found or could not be deleted.');
        }
    }

    // restore lại user đã xóa mềm

    public function restoreUserDestroy($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);

            $user->restore();

            return redirect()->route('users.index')->with('success', 'User permanently deleted.');
        } catch (\Throwable $th) {
            return back()->with('error', 'User not found or could not be deleted.');
        }
    }

}
