<?php

namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RenewTokenSession
{
  public static function refreshToken(Request $request)
  {
    $token = Str::random(80);

    $request->user()->forceFill([
      'api_token' => hash('sha256', $token),
    ])->save();

    $request->session()->put("api_token", $token);
  }
}
