<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Test $test)
    {
        return view('admin.tests.test_questions', [
          'title' => 'Редактирование теста',
          'test' => $test
        ]);
    }

    public function create(Test $test)
    {
        $data = request()->validate([
          'name' => 'required|string|max:255',
          'type' => 'required|string|max:255',
          'data' => 'nullable',
          'correct_answer' => 'nullable'
        ]);

        $array = $data['data'];
        $data['data'] = [];

        if ($array != 'null') {
            $data['data']['select'] = $array;

        } else {
          $data['data'] = NULL;
        }

        $data['position'] = $test->questions()->count();
        $question = $test->questions()->create($data);

        if ($test->type == 'answerTest') {
          $test->correctAnswers()->create(['correct_answer' => $data['correct_answer'], 'question_id' => $question->id]);
        }
        
        return $question;
    }
}
