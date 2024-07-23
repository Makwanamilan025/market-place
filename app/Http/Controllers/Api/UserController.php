<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Mail\ChangePassword;
use App\Mail\ForgetPassword;
use App\Models\Passwordreset as ModelsPasswordreset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function forgotPassword(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if (! $user) {
            return $this->sendError('User email not found', 500);
        }

        $token = str::random(40);
        $datetime = Carbon::now()->format('Y-m-d H:i:s');

         ModelsPasswordreset::updateOrInsert(
            ['email' => $request->email],
            ['email' => $request->email, 'token' => $token, 'created_at' => $datetime]
        );

        Mail::to($user->email)->send(new ForgetPassword($user, $token));

        return $this->sendSuccess('Check your mail inbox to change your password.');
    }

}
