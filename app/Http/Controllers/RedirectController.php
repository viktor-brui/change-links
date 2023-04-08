<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RedirectController extends Controller
{
  /**
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $hash = substr($_SERVER['REQUEST_URI'], 1);

    if ($hash) {
      $response = DB::table('links')->where('hash', $hash)->first();

      if ($response) {
        return redirect($response->link);
      }
    }

    return view('page-not-found');
  }
}
