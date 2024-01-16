<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function User()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    ///////////////////////////////Backend////////////////////////////////
    public function AllUser()
    {
        $user = User::latest()->paginate(8);

        return view('backend.utilisateur.utilisateur_view', compact('user'));
    }
}
