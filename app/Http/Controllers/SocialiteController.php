<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    // Les tableaux des providers autorisés
    protected $providers = ["google", "github", "facebook"];

    # La vue pour les liens vers les providers


    # redirection vers le provider
    public function redirect(Request $request)
    {

        $provider = $request->provider;

        // On vérifie si le provider est autorisé
        if (in_array($provider, $this->providers)) {
            return Socialite::driver($provider)->redirect(); // On redirige vers le provider
        }
        abort(404); // Si le provider n'est pas autorisé
    }

    // Callback du provider
    public function callback(Request $request)
{
    $provider = $request->provider;

    if (in_array($provider, $this->providers)) {
        try {
            $data = Socialite::driver($request->provider)->user();

            $user = $data->user;

            $existingUser = User::where("email", $user["email"])->first();
            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                $password = bin2hex(random_bytes(6)); // Generate a random password
                $authUser = User::create([
                    'name' => $user["given_name"] . " " . $user["family_name"],
                    'email' => $user["email"],
                    'password' => Hash::make($password),
                ]);
                $authUser->assignRole("user");
                event(new Registered($authUser));
                Auth::login($authUser);
            }

            return redirect("/");
        } catch (\Exception $e) {
            // Handle exceptions, e.g., log the error
            return abort(500);
        }
    }
    abort(404);
}

}
