<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
       'cmt',
      'id_user',
      'id_blog',
       'avatar_user',
       'name_user',
      'level',
       'id_user',
        'id_blog',
    ];
}
