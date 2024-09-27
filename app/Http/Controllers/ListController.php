<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin2;
use App\Models\User;
use App\Models\Distributor;

class ListController extends Controller
{
    public function index()
    {
        $admins = Admin2::all();
        $users = User::all();
        $distributors = Distributor::all();

        return view('welcome', compact('admins', 'users', 'distributors'));
    }
}

