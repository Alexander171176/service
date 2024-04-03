<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Http\Resources\Admin\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $roles = Role::all();
        $rolesCount = DB::table('roles')->count();

        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles,
            'rolesCount' => $rolesCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Admin/Roles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): \Illuminate\Http\RedirectResponse
    {
        Role::create($request->validated());
        return to_route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Inertia\Response
    {
        $role = Role::findById($id);

        return Inertia::render('Admin/Roles/Edit', [
            'role' => new RoleResource($role)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $role = Role::findById($id);
        $role->update($request->validated());
        return to_route('roles.index');
        //return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $role = Role::findById($id);
        $role->delete();
        return back();
    }
}
