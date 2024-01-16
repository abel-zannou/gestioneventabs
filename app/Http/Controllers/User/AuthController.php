<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                return response([
                    'message' => 'Successfully Login',
                    'token' => $token,
                    'user' => $user,
                ], 200); //States Code
            }
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }

        return response([
            'message' => 'Invalid Email Or Password',
        ], 401);
    } //End Method

    ///////////////////////////////////BACKEND/////////////////////////////////////////
    public function AddUser()
    {
        return view('backend.utilisateur.utilisateur_add');
    }

    public function Register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('app')->accessToken;

        $notification = array(
            'message' => 'Utilisateur a été créé avec succès',
            'alert-type' => 'success',
        );

        return redirect()->route('user.all')->with($notification);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'You have successfully logged out',
        ]);
    }

    public function UserEdit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.utilisateur.utilisateur_edit', compact('user'));
    }

    public function UserProfileUpdate(Request $request)
    {
        $user_id = $request->id;

        User::findOrFail($user_id)->update([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);

        $notification = [
            'message' => 'L\'utilisateur a été mise à jour avec Succès',
            'alert-type' => 'success'
        ];

        return redirect()->route('user.all')->with($notification);
    }

    public function ProfileDelete($id)
    {
        User::findOrFail($id)->delete();

        $notification = [
            'message' => 'L\'utilisateur a Supprimé avec Succès',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
