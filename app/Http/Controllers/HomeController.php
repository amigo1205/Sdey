<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('homePage');
    }

    public function create_new_application()
    {
      return view('CreateNewApplication');
    }

    public function user_profile()
    {
      return view('UserProfile');
    }

    public function update_terms(Request $request)
    {
        // DB::table('document')->where('id', '=', $document_id)->update($data);
        return succes;
    }
}
