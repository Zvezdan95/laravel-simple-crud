<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(?int $id = null): View
    {
        return view('user.upsert', [
            'user' => User::find($id),
            "userStatuses" => UserStatus::cases(),
        ]);
    }

    public function delete(Request $request): RedirectResponse
    {
        $userDeleted = User::find($request->input("delete_user"))->delete();
        return redirect()->route('admin');
    }

    public function upsert(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::find($request->input("user_id"));
        $user = $user ?? new User();
        $user->fill($request->validated());

        if($profilePicture = $request->file('profile_picture')) {
            $user->setProfilePicture($profilePicture);
        }

        $password = Hash::make($request->input('password'));

        if($password) {
            $user->password = Hash::make($request->input("password"));
        }

        if($user->password){
            $user->save();
        }

        return  redirect()->route('admin');
    }
}
