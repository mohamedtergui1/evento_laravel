<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    function index(){
        $user= auth()->user();
        $events = $user->events;
        $categories = Category::all();
        $myReservation = $user->myReservation()->latest()->get();
        return view("profile",compact("events","categories","myReservation"));
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    function addUserImage(  ){


        return view("addImageUser");

     }
     function updateUserImage(Request $request){
        $request->validate([
            'image' => 'nullable|mimes:png,jpeg,jpg,webp'
        ]);
        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/users/';
            $file->move($path, $fileName);
            $user = auth()->user();
            $user->image =  $fileName;
            $user->save();

            return redirect("/")->with("success" , "image updated successfuly");
        }
         return redirect("/")->with("error" , "image not updated ");
    }
    function changeRole(Request $request){
        $user = auth()->user();

        if($user->hasRole("user")){
            $user->removeRole('user');
            $user->assignRole("organizer");
        } else {
            $user->removeRole("organizer");
            $user->assignRole("user");
        }

        return redirect(route("profile.index"))->with("success" , "Role changed successfully.");
    }
}
