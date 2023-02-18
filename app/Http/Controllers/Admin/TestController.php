<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function create()
    {
        $data = request()->validate([
          'name' => 'required|string|max:255|unique:tests',
        ]);

        auth()->user()->tests()->create($data);

        return redirect()->back();
    }

    public function index()
    {
        return view('admin.tests.test_create', [
          'title' => 'Добавление теста',
          'tests' => Test::latest()->get()
        ]);
    }

}
