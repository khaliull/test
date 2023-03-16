<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
        'category_id',
        'key',
        'type'
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
    public function questionsCount()
    {
        return $this->hasMany('App\Models\Question')->count();
    }

    public function correctAnswers()
    {
        return $this->hasMany('App\Models\CorrectAnswer');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
