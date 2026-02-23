<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::withCount('users')->orderBy('name')->paginate(20);

        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        $this->authorize('create', Role::class);
        $modules = config('permissions.modules', []);
        $actionLabels = config('permissions.action_labels', []);

        return view('roles.create', compact('modules', 'actionLabels'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse|JsonResponse
    {
        $role = Role::create([
            'name' => $request->validated('name'),
            'label' => $request->validated('label'),
            'permissions' => $request->validated('permissions', []),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['id' => $role->id, 'name' => $role->name, 'label' => $role->label]);
        }

        return redirect()->route('roles.index')->with('success', 'Role created.');
    }

    public function show(Role $role): View
    {
        $this->authorize('view', $role);
        $role->loadCount('users')->load('users');

        return view('roles.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        $this->authorize('update', $role);
        $modules = config('permissions.modules', []);
        $actionLabels = config('permissions.action_labels', []);

        return view('roles.edit', compact('role', 'modules', 'actionLabels'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update([
            'name' => $request->validated('name'),
            'label' => $request->validated('label'),
            'permissions' => $request->validated('permissions', []),
        ]);

        return redirect()->route('roles.index')->with('success', 'Role updated.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('delete', $role);
        if ($role->users()->exists()) {
            return redirect()->route('roles.index')->with('error', 'Cannot delete a role that has users assigned. Reassign or remove those users first.');
        }
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role removed.');
    }
}
