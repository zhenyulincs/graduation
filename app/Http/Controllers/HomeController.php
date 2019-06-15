<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Produces;
use App\Http\Resources\ProduceResource;
use App\Http\Resources\UserResource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('queryApi');
        $this->middleware('admin')->only('adminUser');
        $this->middleware('admin')->only('adminProducesManagement');
    }

    
    public function index(Request $request)
    {
        $produces = Produces::where('userid',Auth::User()->id)->paginate(10);
        $result = view('home',[
            "produces"=>$produces
        ]);
        $result=$this->producesOperation($request,$result);
        return $result;
    }
// return view or boolean
    public function adminUser(Request $request)
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

    public function adminProducesManagement(Request $request) {
        $produces = Produces::paginate(10);
        $result = view('admin',[
            "produces"=>$produces
        ]);
        $result=$this->producesOperation($request,$result);
        return $result;
    }

    public function queryApi(Request $request) {
        $produces = Produces::where('title','like','%'.$request['query'].'%')->paginate(10);
        return new ProduceResource($produces);
    }

    public function queryUserApi(Request $request) {
        $user = User::where('id',$request['userid'])->first();
        return new UserResource($user);
    }

    public function producesOperation($request,$result) {
        $result = $result;
        if ($request->ajax()) {
            if (is_array($request['data'])) {
                $num = Produces::create([
                    'title'=>$request["data"][0],
                    'description'=>$request["data"][1],
                    'cover'=>$request["data"][2],
                    'left'=>intval($request["data"][3]),
                    'prices'=>intval($request["data"][4]),
                    'userid'=>Auth::User()->id
                ]);
                if ($num) {
                    $result = "success";
                }
                else {
                    $result = "fail";
                }
            }
            else if($request['deleteId']) {
                $readyDelete = Produces::find(intval($request['deleteId']));
                $readyDelete->delete();
            }
            else{
                $readyUpdate = Produces::find(intval($request['id']));
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
        }
        return $result;
    }

    
}
