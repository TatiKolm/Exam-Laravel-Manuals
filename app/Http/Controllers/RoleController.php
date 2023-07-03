<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index', [
            'roles' => Role::all()->sortBy("name")
        ]);
    }

    public function create()
    {
        return view("roles.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        return view("roles.edit", [
            'role' => $role,
            'permissions' => Permission::all()->sortBy("name")
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role->update($request->all());
        $role->syncPermissions($request->input("permissions"));

        return redirect()->route('roles.index');
    }
}
