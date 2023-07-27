<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\PassedTest;
use App\Models\Question;
use App\Models\Answer;
use App\Models\PairedTest;
use App\Models\Fact;

class ResultTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tests = auth()->user()->passedTest()->select('passed_tests.created_at as created_at', 'tests.name as name', 'tests.key as key', 'passed_tests.id as passed_test_id', 'passed_tests.finished as finished')->join('tests', 'passed_tests.test_id', 'tests.id')->latest('passed_tests.created_at')->get();

        return view('tests.results.all_tests', [
          'title' => 'Результаты прохождения тестов',
          'tests' => $tests
        ]);
    }

    public function test($key, PassedTest $passedTest)
    {
        $test = Test::where('key', $key)->first();

        abort_unless($test && $passedTest['user_id'] == auth()->user()->id, 404);
        $questions = [];
        $result = [];
        $text = '';
        $progress = 0;

        $facts = Fact::select('facts.content')->inRandomOrder()->limit(3)->get();

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
              $secondPassedTest = PassedTest::where('test_id', $test->id)->where('id', $pairedTestUsers->first_passed_test_id)->first();
            }
          }

          $matchedAnswers = 0;
          $newText = '';
          foreach ($questionsTest as $key => $question) {
            $firstUser = $passedTest->answers()->where('question_id', $question->id)->first();
            $secondUser = null;

            if ($secondPassedTest) {
              $secondUser = $secondPassedTest->answers()->where('question_id', $question->id)->first();
            }

            if (isset($secondUser->answer)) {
              if ($secondUser->answer == $firstUser->answer) {
                $matchedAnswers += 1;
              }
            } else {
              $newText = 'Ожидание результатов партнера';
            }





            $array = [
              'name' => $question->position + 1,
              'firstUser' => $firstUser->answer,
              'secondUser' => $secondUser ? $secondUser->answer : "Ожидание партнера",
              'questionName' => $question->name
            ];

            $result[$key] = $array;
          }

          $progress = $matchedAnswers / $questionsTest->count();

          if (!$newText) {
            if ($progress < 0.4) {
              $text = $test->data['result_bad'];
            } elseif ($progress >= 0.4 && $progress <= 0.6) {
              $text = $test->data['result_normal'];
            } else {
              $text = $test->data['result_good'];
            }
          } else {
            $text = $newText;
          }


        } else if ($test->type == 'answerTest') {

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

        $count = $questions->count();
        $correctCount = 0;

        foreach ($questions as $key => $question) {
          if ($question->answer == $question->correct_answer) {
            $correctCount += 1;
          }
        }
        $progress = $correctCount/$count;
        if ($progress == 0) {
          $progress = 0.004;
        }
        if ($progress < 0.4) {
          $text = $test->data['result_bad'];
        } elseif ($progress >= 0.4 && $progress <= 0.6) {
          $text = $test->data['result_normal'];
        } else {
          $text = $test->data['result_good'];
        }
      } elseif ($test->type == 'psychologyTest') {
        // code...
      }

    

        return view('tests.results.test', [
          'title' => 'Результаты прохождения тестa',
          'test' => $test,
          'questions' => $questions,
          'result' => $result,
          'text' => $text,
          'facts' => $facts,
          'progress' => $progress
        ]);
    }
}
