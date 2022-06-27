<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller 
{
    public function index()
    {
        return view('admin.user.login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->put('email', null);
        return redirect()->route('get-login');
    }


    public function validation(Request $request){ // validate du liệu
        return $this->validate($request, [
            'admin_email' => 'required|email:filter|max:255',
            'admin_password' => 'required|max:255'
        ]);
    }

    public function store(Request $request)
    {
        $validate = $this->validation($request);
        if($validate == true){
            if(Auth::attempt([
                'email' => $request->input('admin_email'),
                'password' => $request->input('admin_password')
            ])){
                $request->session()->regenerate();
                session()->put('success', 'Successfully logged in');
                session()->put('email', $request->input('admin_email'));
                return redirect()->intended('admin/dashboard');
            }else{
                session()->put('error', 'Login Failed');
                return redirect()->back();
            }
        }else{
            session()->put('error', 'Login Failed');
            return redirect()->back();
        }
    }

    public function show(Request $request)
    {
        $id = $request->cookie('user_id');
        $user = User::find($id);
        $user->getPermissionsViaRoles();
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'user' => $user
        ]);
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
