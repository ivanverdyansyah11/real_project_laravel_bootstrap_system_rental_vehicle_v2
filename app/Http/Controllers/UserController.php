<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        private readonly AuthRepositories $authRepositories
    ) {
    }

    public function index()
    {
        return view('dashboard.authentication.login', [
            'title' => 'Login Page',
            'page' => 'Dashboard',
        ]);
    }

    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->validated())) {
                $request->session()->regenerate();
                return redirect()->route('dashboard.index');
            } else {
                return redirect(route('login.index'))->with('failed', 'Email or password not found!');
            }
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('login.index'))->with('failed', 'Email or password not found!');
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authRepositories->logout($request);
            return redirect()->route("login.index")->with('success', 'Successfully to logout account!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->route("dashboard.index")->with('error', 'Failed to logout account!');
        }
    }
}
