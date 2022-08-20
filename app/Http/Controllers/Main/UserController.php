<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('main.user.index', compact('user'));
    }
}
