<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\PassedTest;
use App\Models\Question;
use App\Models\Answer;
use App\Models\PairedTest;

class ResultTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allTests()
    {
        return view('tests.results.all_tests', [
          'title' => 'Результаты прохождения тестов',
        ]);
    }

    public function test($key, PassedTest $passedTest)
    {
        $test = Test::where('key', $key)->first();

        abort_unless($test, 404);
        $questions = [];
        $result = [];

        $questionsTest = Question::where('questions.test_id', $test->id)->get();


        if ($test->type == 'pairedTest') {

          $secondPassedTest = null;
          $pairedTestUsers = PairedTest::where('first_passed_test_id', $passedTest->id)->whereNotNull('second_passed_test_id')->where('first_finished', 1)->first();

          if ($pairedTestUsers) {
            $secondPassedTest = PassedTest::where('test_id', $test->id)->where('id', $pairedTestUsers->second_passed_test_id)->first();
          }

          if (!$pairedTestUsers) {
            $pairedTestUsers = PairedTest::where('second_passed_test_id', $passedTest->id)->whereNotNull('first_passed_test_id')->where('second_finished', 1)->first();

            if ($pairedTestUsers) {
              $secondPassedTest = PassedTest::where('test_id', $test->id)->where('id', $pairedTestUsers->second_passed_test_id)->first();
            }
          }
          if ($pairedTestUsers) {
            // code...
          }

          foreach ($questionsTest as $key => $question) {
            $firstUser = $passedTest->answers()->where('question_id', $question->id)->first();
            $secondUser = null;

            if ($secondPassedTest) {
              $secondUser = $secondPassedTest->answers()->where('question_id', $question->id)->first();
            }

            $array = [
              'name' => $question->position + 1,
              'firstUser' => $firstUser->answer,
              'secondUser' => $secondUser ? $secondUser->answer : "Ожидание собеседника",
              'questionName' => $question->name
            ];

            $result[$key] = $array;
          }



        } else {

        $questions = Question::where('questions.test_id', $test->id)->join('correct_answers', 'questions.id', '=','correct_answers.question_id')->join('answers', 'questions.id', 'answers.question_id')->where('answers.passed_test_id', $passedTest->id)->get();


        foreach ($questionsTest as $key => $question) {
            $correct =  Answer::where('answers.question_id', $question->id)->join('correct_answers', function ($join)  {
                $join->on('answers.question_id', '=', 'correct_answers.question_id')->on('correct_answers.correct_answer', 'answers.answer');
            })->count();

            $notCorrect =  Answer::where('answers.question_id', $question->id)->join('correct_answers', function ($join)  {
                $join->on('answers.question_id', '=', 'correct_answers.question_id')->on('correct_answers.correct_answer', '!=', 'answers.answer');
            })->count();

            $array = [
              'name' => $question->position + 1,
              'Верно ответили' => $correct,
              'Не правильно ответили' => $notCorrect
            ];

            $result[$key] = $array;
        }
      }
        return view('tests.results.test', [
          'title' => 'Результаты прохождения тестa',
          'test' => $test,
          'questions' => $questions,
          'result' => $result
        ]);
    }
}
