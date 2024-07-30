<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if($request->user()->hasVerifiedEmail()){
            $request->user()->status = UserStatus::ACTIVE;
        }
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('admin', absolute: false))
                    : view('auth.verify-email');
    }
}
