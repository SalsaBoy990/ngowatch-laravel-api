<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Support\InteractsWithBanner;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    use InteractsWithBanner;


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function index()
    {
        $permissions = Permission::with('roles')->get();
        $roles = Role::with('permissions')->get();

        return view('pages.admin.role_permission.manage')->with([
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }
}
