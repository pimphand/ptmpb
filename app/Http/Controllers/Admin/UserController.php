<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', [
            'title' => 'User',
            'roles' => Role::whereNot('name', 'developer')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create(array_merge($request->validated(), [
            'password' => bcrypt($request->password),
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('images/user', 'public') : null
        ]));

        $user->addRole($request->input('role'));

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update(array_merge($request->validated(), [
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('images/user', 'public') : $user->photo
        ]));
        $user->roles()->sync($request->input('role'));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User has been deleted']);
    }

    /**
     * get all user data
     */
    public function data(Request $request)
    {
        $users = User::when(! $request->role, function ($query) {
            $query->whereHasRole(['admin', 'sales', 'content', 'driver']);
        })
            ->when($request->role, function ($query) use ($request) {
                $query->whereHasRole($request->role);
            })
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'developer');
            })
            ->with('roles:id,display_name,name')
            ->paginate(10);

        return UserResource::collection($users);
    }
}
