<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // 可修改字段
    protected $fillable = ['content'];

    // 一条微博对应一个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
