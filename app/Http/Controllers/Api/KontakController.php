<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kontak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    public $pesanSukses = 200;
    public $pesanError = 401;

    public function login(Request $request)
    {
        # code...
        $validasi = Validator::make($request->all(),[
            'kontak' => 'required|min:10|max:14',
        ]);

        if ($validasi->fails()) {
            # code...
            return \response()->json(['error'=>$validasi->errors()],$this->pesanError);
        }

        $input = $request->all();
        $clientIP = \Request::getClientIp(true);
        $input['kontak'] = $input['kontak'];
        $input['ip_access'] = $clientIP;
        $input['create_by'] = $input['kontak'];

        if($no = Kontak::where(['kontak' => $input])->first()){
            $sukses['id'] = $no->id;
            $sukses['token'] = $no->createToken($input)->accessToken;
            return \response()->json([
                'sukses' => 'login',
                'token_type' => 'Bearer',
                'akses-token' => $sukses,
            ],$this->pesanSukses);
        }else {
            # code...
            $kontakku = Kontak::create($input);
            $sukses['id'] = $kontakku->id;
            $sukses['token'] = $kontakku->createToken($input)->accessToken;
            return \response()->json([
                'sukses' => 'register',
                'token_type' => 'Bearer',
                'akses-token' => $sukses,
            ], $this->pesanSukses);
        }
    }
}
