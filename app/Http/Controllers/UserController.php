<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit(){
        return view('auth.edit-profile');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'photo' => 'required|max:2048'
        ]);

        try{
            $newPhotoFileName = "";
            if ($request->hasFile('photo')) {
                // Delete the previous image from storage
                $previousImagePath = 'public/users/' . $user->image_url;
                if (Storage::exists($previousImagePath) && $user->image_url != "unknown.jpg") {
                    Storage::delete($previousImagePath);
                }
    
                // Upload the new photo to storage
                $newPhotoFileName = time() . '.' . $request->photo->extension();
                $request->photo->storeAs('public/users', $newPhotoFileName);
                $user->image_url = $newPhotoFileName;
            }

            $user->update([
                'username' => $validatedData['username'],
                'address' => $validatedData['address'],
                'email' => $validatedData['phone_number'],
                'birthdate' => $validatedData['birthdate'],
                'gender' => $validatedData['gender'],
            ]);

            return redirect()->route('welcome');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function account(Request $request){
        $user = Auth::user();
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'gender' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
        ]);

        try{
            $newPhotoFileName = "";
            if ($request->hasFile('photo')) {
                // Delete the previous image from storage
                $previousImagePath = 'public/users/' . $user->image_url;
                if (Storage::exists($previousImagePath)) {
                    Storage::delete($previousImagePath);
                }
    
                // Upload the new photo to storage
                $newPhotoFileName = time() . '.' . $request->photo->extension();
                $request->photo->storeAs('public/users', $newPhotoFileName);
                $user->image_url = $newPhotoFileName;
            }

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
            ]);

            return redirect()->back()->with('message', 'Updated Account Successfully');;
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(){
        $user = Auth::user();
        $user->delete();

        return redirect()->route('login');
    }
}
