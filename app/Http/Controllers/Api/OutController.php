<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;

class OutController extends Controller
{   
    public $pesanSukses = 200;
    public $pesanError = 401;
    
    public function logout()
    {
        # code...
        $kontak = Auth::guard('kontak')->user()->token();
        if ($kontak->revoke()) {
            # code...
            $user = Auth::guard('api')->user()->token();
            if ($user->revoke()) {
                # code...
                return \response()->json([
                    'sukses' => 'selamat tinggal',
                    'kode' => $this->pesanSukses
                ],$this->pesanSukses);
            }
        }else {
            # code...
            return \response()->json([
                'error' => 'maaf gagal',
                'kode' => $this->pesanError
            ],$this->pesanError);
        }
    }
    
}
