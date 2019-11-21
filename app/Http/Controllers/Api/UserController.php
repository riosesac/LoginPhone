<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $pesanSukses = 200;
    public $pesanError = 401;

    public function register(Request $request)
    {
        # code...

        $input = $request->all();
        $input['kontak_id'] = Auth::guard('kontak')->user()->id;

        if ($user = User::where(['kontak_id' => $input])->first()) {
            # code...
            $sukses['user_id'] = $user->id;
            $sukses['token'] = $user->createToken($user)->accessToken;
            return \response()->json([
                'sukses' => 'login',
                'token_type' => 'Bearer',
                'akses-token' => $sukses,
            ],$this->pesanSukses);
        }else {
            # code... 
            $input['kontak_id'] = Auth::guard('kontak')->user()->id;
            $input['name'] = $input['name'];
            $input['email'] = $input['email'];
            $clientIP = \Request::getClientIp(true);
            $input['ip_access'] = $clientIP;
            $input['create_by'] = $input['kontak_id'];
            $userku = User::create($input);
            $sukses['id'] = $userku->id;
            $sukses['token'] = $userku->createToken($input)->accessToken;
            return \response()->json([
                'sukses' => 'register',
                'token_type' => 'Bearer',
                'akses-token' => $sukses,
            ], $this->pesanSukses);
        }
    }

    public function details()
    {
        # code...
        $user['nama'] = auth()->guard('api')->user()->name;
        $user['phone'] = auth()->guard('kontak')->user()->kontak;
        return \response()->json([
            'details-user' => $user,
        ]);
    }
}
