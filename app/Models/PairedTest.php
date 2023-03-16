<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairedTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_user_id', 'second_user_id', 'test_id', 'key', 'first_passed_test_id', 'second_passed_test_id', 'first_finished', 'second_finished', 'finished'
    ];
}
