<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Produces;

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
        $this->middleware('admin')->only('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
// return view or boolean
    public function admin(Request $request)
    {
        $users = User::paginate(10);
        $result = view('admin',[
            "users"=>$users
        ]);
        if ($request->ajax()) {
            $readyUpdate = User::find(intval($request['id']));
            $num = $readyUpdate->update(
                [$request['field']=>$request['data']]
            );
            if ($num == 1) {
                $result = 'success';
            }
            else {
                $result = 'fail';
            }
        }
        return $result;
    }

    public function producesManagement(Request $request) {
        $produces = Produces::paginate(10);
        $result = view('admin',[
            "produces"=>$produces
        ]);
        return $result;
    }
}
