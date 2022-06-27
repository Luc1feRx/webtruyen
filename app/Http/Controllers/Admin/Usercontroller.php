<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Usercontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        // $id = $request->cookie('user_id');
        // $user = User::find($id);
        // if($user){
        //     $user->givePermissionTo(['add user','edit user', 'delete user']);
        // }
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'publish category']);
        $user = User::with('roles', 'permissions')->get();
        return view('admin.user.index', [
            'title' => 'Danh Sách User',
            'users' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::orderBy('id', 'desc')->get();
        return view('admin.user.add', [
            'title' => 'Thêm User mới',
            'roles' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // dd($user->password);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

    }

    public function ApprovePermission($id){
        $user = User::findOrFail($id);
        $name_roles = $user->roles->first()->name;
        $permissions = Permission::orderBy('id', 'desc')->get();
        $get_permission_via_role = $user->getPermissionsViaRoles();
        return view('admin.user.approveper', [
            'title' => 'Phân Quyền',
            'user' => $user,
            'name_roles' => $name_roles,
            'permissions' => $permissions,
            'get_permission_via_role' => $get_permission_via_role
        ]);
    }

    public function insertPermission($id, Request $request){
        $data = $request->all();

        $user = User::find($id);
        $role_id = $user->roles->first()->id;
        $role = Role::find($role_id);

        $role->syncPermissions($data['permission']);
        return redirect()->route('user.index')->with('success', 'Phân Quyền Thành Công');
    }

    public function insertRole($id, Request $request){
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        return redirect()->route('user.index')->with('success', 'Phân Vai Trò Thành Công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    

    public function ApproveRole($id)
    {
        $user = User::findOrFail($id);
        $name_roles = $user->roles->first()->name;
        $roles = Role::orderBy('id', 'desc')->get();
        $all_column_roles = $user->roles->first();
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('admin.user.approverole', [
            'title' => 'Phân Vai Trò',
            'user' => $user,
            'roles' => $roles,
            'column_roles' => $all_column_roles,
            'name_roles' => $name_roles,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
