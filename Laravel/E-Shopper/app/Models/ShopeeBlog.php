<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeBlog extends Model
{
    use HasFactory;

    protected $table = "shopee_blogs";

    protected $fillable = [
       'tittle',
       'avatar',
       'description',
       'content'
    ];
}
