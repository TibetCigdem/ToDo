<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    //delete user_id if it wont work
    protected $fillable = ['user_id','title','description','status'];
}
