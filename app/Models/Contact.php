<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Contact extends Model
{
    protected $fillable = ['name','email','phone_number','address','user_id'];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
  
}
