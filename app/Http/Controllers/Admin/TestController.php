<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestType;
use App\Models\Category;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::all();
        $types = TestType::all();

        return view('admin.tests.test_create', [
          'title' => 'Добавление теста',
          'tests' => Test::latest()->get(),
          'categories' => $categories,
          'types' => $types
        ]);
    }

    public function createCategory()
    {
        $data = request()->validate([
          'title' => 'required|string|max:255',
          'header_text' => 'required|string',
        ]);

        $category = Category::create($data);

        return redirect()->back();
    }

    public function createCategoryIndex()
    {
        $categories = Category::all();

        return view('admin.tests.category_create', [
          'title' => 'Добавление категорий',
          'categories' => $categories
        ]);
    }

    public function create()
    {
        $data = request()->validate([
          'name' => 'required|string|max:255|unique:tests',
          'type' => 'required|string|max:255',
          'category_id' => 'required',
        ]);

        $data['key'] = Str::random(24);

        auth()->user()->tests()->create($data);

        return redirect()->back();
    }

}
