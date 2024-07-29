<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequests;
use App\Http\Requests\ResetPassword as RequestsResetPassword;
use App\Http\Requests\UserRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\OwnerResource;
use App\Http\Resources\RagisterResource;
use App\Models\Passwordreset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function register(UserRequest $request): JsonResponse
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->token = $user->createToken('Auth Token')->accessToken;
        $user = new RagisterResource($user);

        return $this->sendResponse($user, 'User registration successfully.');
    }


    public function signIn(LoginRequests $request): JsonResponse
    {
        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            return $this->sendError('User email not found.', 500);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user->token = $user->createToken('API Token')->accessToken;
            $user = new AdminResource($user);

            return $this->sendResponse($user, 'User login successfully.');
        }

        return $this->sendError('Incorrect password.', 500);
    }

    public function ResetPassword(Request $request)
    {
        $resetData = Passwordreset::where('token', $request->token)->where('email', $request->email)->first();
        if (isset($resetData)) {
            return view('User.resetpassword', compact('resetData'));
        }

        return $this->sendError('Something wrong or not found.', 500);
    }

    public function userSetpassword(RequestsResetPassword $request)
    {
        $user = User::whereEmail($request->email)->first();
        $user->password = $request->password;
        $user->save();

        Passwordreset::whereEmail($user->email)->delete();

        return view('User.success');
    }

   public function changePassword(Request $request): JsonResponse
    {
        
        $user = Auth::user();
        $password = $user->password;

        if (Hash::check($request->old_password, $password)) {
            $user->password = $request->password;
            $user->save();

            return $this->sendSuccess('Successfully changed your password you can login with new password');
        }

        return $this->sendError('Old password does not match.', 500);
    }

    public function getProfile()
    {
        $user = Auth::user();
        $user = new OwnerResource($user);

        return $this->sendResponse($user, 'Profile show successfully.');
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();

        return $this->sendSuccess('User logged out successfully.');
    }


}
