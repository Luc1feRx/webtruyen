<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $id = $request->cookie('user_id');
        $name = $request->cookie('user_name');
        $user = User::find($id);
        $user->getPermissionsViaRoles();
        Carbon::setLocale('vi');
        View::share('user', $user);
        View::share('name', $name);
    }
}
