<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassedTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'test_id', 'finished', 'paired_test_key'
    ];

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
    public function answersCount()
    {
        return $this->hasMany('App\Models\Answer')->count();
    }
}
