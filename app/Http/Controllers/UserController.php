<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', User::class);
        $users = User::with('role')->orderBy('name')->paginate(20);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $this->authorize('create', User::class);
        $roles = Role::orderBy('name')->get();
        $modules = config('permissions.modules', []);
        $actionLabels = config('permissions.action_labels', []);

        return view('users.create', compact('roles', 'modules', 'actionLabels'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
            'role_id' => $request->validated('role_id'),
        ]);

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function show(User $user): View
    {
        $this->authorize('view', $user);
        $user->load('role');

        return view('users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);
        $roles = Role::orderBy('name')->get();
        $modules = config('permissions.modules', []);
        $actionLabels = config('permissions.action_labels', []);

        return view('users.edit', compact('user', 'roles', 'modules', 'actionLabels'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();
        unset($data['password_confirmation']);
        if (empty($data['password'])) {
            unset($data['password']);
        }
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);
        if ($user->id === auth()->id()) {
            auth()->logout();
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User removed.');
    }
}
