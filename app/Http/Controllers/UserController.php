<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function update(Request $request): RedirectResponse|View
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'birthdate' => 'required|date',
            'gender' => 'required|string|in:Male,Female,Other,Declined',
        ]);

        $user->update($validatedData);

        // return redirect()->intended(route('test'));
        return view('testaaa');
    }
}
