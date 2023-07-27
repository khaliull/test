<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\PassedTest;
use App\Models\Question;
use App\Models\Answer;
use App\Models\PairedTest;
use App\Models\Category;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();

        return view('tests.index', [
          'title' => 'Прохождение тестов, все виды тестов',
          'categories' => $categories,
        ]);
    }

    public function pairedTest(Request $request)
    {

        $pairedTest = PairedTest::where('key', $request->key)->whereNull('second_user_id')->first();

        if (!$pairedTest) {
           $request->session()->flash('pairedTestVerification', 'Тест с таким ключом приглашения не найден');
           return redirect()->back();
        }

        if ($pairedTest->first_user_id == auth()->user()->id) {
          $request->session()->flash('pairedTestVerification', 'Данного пользователя невозможно пригласить для прохождения совместного теста');
          return redirect()->back();
        }

        $pairedTest->update(['second_user_id' => auth()->user()->id]);

        $test = Test::where('id', $pairedTest['test_id'])->first();

        return view('tests.show', [
          'title' => 'Прохождение теста',
          'test' => $test,
          'pairedTestKeyShow' => $request->key
        ]);
    }

    public function testCategories(Category $category)
    {
        $tests = Test::where('active', 1)->where('category_id', $category->id)->get();

        return view('tests.category', [
          'title' => 'Прохождение тестов, все виды тестов',
          'tests' => $tests,
          'category' => $category,
        ]);
    }

    public function testShow($category, $key)
    {
        $test = Test::where('key', $key)->first();

        abort_unless($test, 404);

        return view('tests.show', [
          'title' => 'Прохождение теста',
          'test' => $test,
          'pairedTestKeyShow' => null
        ]);
    }

    public function testCompleted($key)
    {

        $test = Test::where('key', $key)->first();

        abort_unless($test, 404);

        $passedTest = PassedTest::where('user_id', auth()->user()->id)->where('finished', 0)->where('test_id', $test->id)->orderBy('created_at', 'desc')->first();

        abort_unless($passedTest, 404);

        $questionsCountTest = $test->questionsCount();
        $questionsCountPassedTest = $passedTest->answersCount();

        if ($questionsCountTest == $questionsCountPassedTest) {
          $passedTest->update(['finished' => 1]);

          if ($test->type == "pairedTest") {
            $pairedTest = PairedTest::where('test_id', $test->id)->where('second_passed_test_id', $passedTest->id)->where('second_finished', 0)->first();
            if ($pairedTest) {
              $pairedTest->update(['second_finished' => 1]);

              if ($pairedTest['first_finished'] == 1 && $pairedTest['second_finished'] == 1) {
                $pairedTest->update(['finished' => 1]);
              }

            } else {
              $pairedTest = PairedTest::where('test_id', $test->id)->where('first_passed_test_id', $passedTest->id)->where('first_finished', 0);

              if ($pairedTest) {

                $pairedTest->update(['first_finished' => 1]);

              }
            }

          }
        }

        return $passedTest->id;
    }

    public function lastQuestion($key, Question $question)
    {
        $test = Test::where('key', $key)->first();

        abort_unless($test, 404);

        $passedTest = PassedTest::where('user_id', auth()->user()->id)->where('finished', 0)->where('test_id', $test->id)->orderBy('created_at', 'desc')->first();

        $question = Question::where('test_id', $test->id)->where('position', $question->position - 1)->first();
        $lastQuestion = Answer::where('passed_test_id', $passedTest->id)->where('question_id', $question->id)->first();

        return [
          'question' => $question,
          'lastAnswer' => $lastQuestion
        ];
    }

    public function pairedTestKey($key, $keyPairedTest)
    {
      $test = Test::where('key', $key)->first();

      abort_unless($test, 404);

      $passedTest = PassedTest::where('user_id', auth()->user()->id)->where('finished', 0)->where('test_id', $test->id)->orderBy('created_at', 'desc')->first();

      if ($test->type == 'pairedTest') {

        $pairedTestKeyModel = PairedTest::where('key', $keyPairedTest)->first();

        if (!$pairedTestKeyModel) {
          $pairedTest = PairedTest::create([
            'first_user_id' => auth()->user()->id,
            'test_id' => $test->id,
            'key' => $keyPairedTest,
            'first_passed_test_id' => $passedTest->id
          ]);
        }
      }
      return;
    }

    public function testGetQuestions($key)
    {
        $test = Test::where('key', $key)->first();

        abort_unless($test, 404);

        $data['questions'] = $test->questions()->get();

        $passedTest = PassedTest::where('user_id', auth()->user()->id)->where('finished', 0)->where('test_id', $test->id)->orderBy('created_at', 'desc')->first();

        if (!isset($passedTest)) {
          $passedTest = auth()->user()->passedTest()->create(['test_id' => $test->id]);
        }

        $data['keyPairedTest'] = null;


        if ($test->type == 'pairedTest') {
          $keyPairedTest = Str::random(24);

          $data['keyPairedTest'] = $keyPairedTest;

          $pairedTest = PairedTest::where('key', request()->pairedTestKeyShow)->where('second_user_id', auth()->user()->id)->whereNull('second_passed_test_id')->first();

          if ($pairedTest) {
            $pairedTest->update(['second_passed_test_id' => $passedTest->id]);
          }
        }

        $answer = $passedTest->answers()->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();

        if ($answer) {
          $question = Question::where('test_id', $test->id)->where('id', $answer->question_id)->first();

          $nextQuestion = Question::where('test_id', $test->id)->where('position', $question->position + 1)->first();
          $nextTwoQuestion = Question::where('test_id', $test->id)->where('position', $question->position + 2)->first();

          $data['nextQuestion'] = $nextQuestion;
          $data['nextTwoQuestion'] = isset($nextTwoQuestion);

        } else {

          $nextQuestion = Question::where('test_id', $test->id)->first();
          $nextTwoQuestion = Question::where('test_id', $test->id)->where('position', $nextQuestion->position + 1)->first();

          $data['nextQuestion'] = $nextQuestion;
          $data['nextTwoQuestion'] = isset($nextTwoQuestion);

        }

        return $data;
    }

    public function testSendQuestions($key)
    {
        $data = request()->validate([
          'answer' => 'required|string|max:255',
          'question_id' => 'required',
        ]);

        $question = Question::where('id', $data['question_id'])->first();

        abort_unless($question, 403);

        $test = Test::where('key', $key)->first();

        $passedTest = PassedTest::where('user_id', auth()->user()->id)->where('finished', 0)->where('test_id', $test->id)->orderBy('created_at', 'desc')->first();

        if (!isset($passedTest)) {
          $passedTest = auth()->user()->passedTest()->create(['test_id' => $test->id]);
        }

        $answer = $passedTest->answers()->where('question_id', $data['question_id'])->first();

        if ($answer) {
          $answer->update(['answer' => $data['answer']]);
        } else {
          $answer = $passedTest->answers()->create([
            'user_id' => auth()->user()->id,
            'question_id' => $data['question_id'],
            'answer' => $data['answer']
          ]);
        }

        $nextQuestion = Question::where('test_id', $test->id)->where('position', $question->position + 1)->first();
        $nextTwoQuestion = Question::where('test_id', $test->id)->where('position', $question->position + 2)->first();

        if ($nextQuestion) {
          $nextAnswer = $passedTest->answers()->where('question_id', $nextQuestion->id)->first();
        } else {
          return [
            'nextQuestion' => $nextQuestion,
            'answer' => null,
            'nextTwoQuestion' => isset($nextTwoQuestion),
          ];
        }

        return [
          'nextQuestion' => $nextQuestion,
          'answer' => $nextAnswer ? $nextAnswer->answer : null,
          'nextTwoQuestion' => isset($nextTwoQuestion),
        ];
    }

}
