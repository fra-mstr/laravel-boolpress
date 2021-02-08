<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
  public function guest() {
    if (Auth::check()) {
      return redirect()->route('restricted-zone');
    } else {
      return view('hello');
    }
  }

  public function admin() {
    $user = Auth::user();

    return view('hello', ['user' => $user]);
  }
}
