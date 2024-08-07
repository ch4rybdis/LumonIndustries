<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

class EmployeeDataMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $fullName = $user->employee_name . " " . substr($user->employee_surname, 0, 1) . ".";
            $image = Image::where('image_id', $user->image_id)->first();
            $imageLink = $image->image_link;

            view()->share('fullName', $fullName);
            view()->share('imageLink', $imageLink);
        }

        return $next($request);
    }
}
