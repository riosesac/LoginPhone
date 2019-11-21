<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontak extends Authenticatable
{
    use HasApiTokens,Notifiable,SoftDeletes;
    
    protected $table = 'kontaks';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'id'
    ];
    protected $hidden = [
        'kontak','ip_access','create_by'
    ];
    
}
