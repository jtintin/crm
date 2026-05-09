<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','name','email','phone','position','notes','active'];
    //relación, 1 contacto pertenece a un cliente
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
