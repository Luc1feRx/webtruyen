<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login', 'register', 'index']]);
    }


    public function register(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'name' => 'min:2|string|required',
                'email' => 'email|required',
                'password' => 'string|min:1|required',
            ], [
                'email.required' => 'Bạn chưa nhập email',
                'name.min' => 'Cần phải ít nhất 2 ký tự',
                'name.required' => 'Bạn chưa nhập tên',
                'password.required' => 'Bạn chưa nhập mật khẩu'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
            }
            $user = User::create([
                'name' => request()->name,
                'email' => request()->email,
                'password' => bcrypt(request()->password),
            ]);
        } catch (BindingResolutionException $e) {
        }

        return response()->json(['message' => 'Registration successful', 'user' => $user]);

    }

    public function index()
    {
        return view('admin.user.login', [
            'title' => 'Login'
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}