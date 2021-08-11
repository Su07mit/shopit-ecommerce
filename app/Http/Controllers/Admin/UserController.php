<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MediaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $roles = [
        'User',
        'Admin',
    ];

    public function index(): View
    {
        $users = User::paginate(12);
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = $this->roles;
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => ['required', Password::min(6)->mixedCase()->numbers()->uncompromised()],
            'role'      => ['required', Rule::in($this->roles)],
            'image'     => ['nullable', 'image', 'mimes:png,jpg,gif'],
        ]);

        $data['password'] = bcrypt($data['password']);

        // use if guarded property is used 
        // unset($data['image']);

        if ($request->hasFile('image')) {
            $data['media_id'] = (new MediaService)->upload($request->file('image'), 'users');
        }

        User::create($data);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'role' => $request->roles,
        // ]);

        return redirect()->route('admin.users.index')->with('success', 'New User Created Successfully!');
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $roles = $this->roles;

        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'email', 'unique:users,email,' . $user->id],
            'password'  => ['nullable', Password::min(6)->mixedCase()->numbers()->uncompromised()],
            'role'      => ['required', Rule::in($this->roles)],
            'image'     => ['nullable', 'image', 'mimes:png,jpg,gif'],
        ]);

        if (!empty($request->password)) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->media_id && $user->media) {
                Storage::delete('public/' . $user->media->path);
            }

            $data['media_id'] = (new MediaService)->upload($request->file('image'), 'users');
        }


        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully!');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->media_id && $user->media) {
            Storage::delete('public/' . $user->media->path);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User Deleted Successfully!');
    }
}
