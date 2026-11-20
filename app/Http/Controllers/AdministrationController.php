<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class AdministrationController extends Controller
{
    public function index(): View
    {
        return view('admin.index', [
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }
}
