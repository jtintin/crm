<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','status','due_date','user_id','client_id'];
    //una tarea pertenece a un usuario o un cliente
    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function client()
    {
        $this->belongsTo(Client::class);
    }
}
//una tarea pertenece a un usuario

