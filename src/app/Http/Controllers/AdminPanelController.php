<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPanelController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            "userStatuses" => UserStatus::cases(),
            "users" => User::all(),
            "userHeaders" => [
                "profile_picture" => "Profile Picture",
                "name" => "Name",
                "username" => "Username",
                "email" => "Email",
                "phone_number" => "Phone Number",
                "status" => "Status"
            ]
        ]);
    }

    public function deleteUser(Request $request): RedirectResponse
    {
        $userDeleted = User::find($request->input("delete_user"))->delete();
        return redirect("/admin");
    }
    public function changeUserStatus(Request $request): RedirectResponse
    {
        ["status" => $status, "selected" =>$selected] = $request->input();
        $userIds = array_keys($selected);
        $usersEffected = User::whereIn("id", $userIds)->update(["status" => $status]);

        return redirect("/admin");
    }
}
