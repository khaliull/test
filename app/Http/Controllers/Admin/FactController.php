<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fact;

class FactController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('admin');
  }

  public function index()
  {
      $facts = Fact::all();

      return view('admin.facts.index', [
        'title' => 'Факты',
        'facts' => $facts
      ]);
  }

  public function create()
  {
      $data = request()->validate([
        'content' => 'required',
      ]);

      Fact::create($data);

      return redirect()->back();
  }
}
