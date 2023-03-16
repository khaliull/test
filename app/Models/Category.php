<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'header_text'
    ];

    public function tests()
    {
        return $this->hasMany('App\Models\Test');
    }
}
