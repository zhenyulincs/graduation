<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Produces;
use App\Http\Resources\ProduceResource;
use App\Http\Resources\UserResource;
use App\Message;
use App\Schedule;

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
        $this->middleware('auth')->except('queryUserApi');
        $this->middleware('admin')->only('adminUser');
        $this->middleware('admin')->only('adminProducesManagement');
        $this->middleware('admin')->only('adminMessage');
        $this->middleware('admin')->only('adminPersonalInfo');
        
    }


    public function UserProducesManagement(Request $request)
    {
        $produces = Produces::where('userid', Auth::User()->id)->paginate(10);
        $result = view('users.producesManagement', [
            "produces" => $produces
        ]);
        $result = $this->producesOperation($request, $result);
        return $result;
    }
    // return view or boolean
    public function adminUser(Request $request)
    {
        $users = User::paginate(10);
        $result = view('admin.userManagement', [
            "users" => $users
        ]);
        if ($request->ajax()) {
            $readyUpdate = User::find(intval($request['id']));
            $num = $readyUpdate->update(
                [$request['field'] => $request['data']]
            );
            if ($num == 1) {
                $result = 'success';
            } else {
                $result = 'fail';
            }
        }
        return $result;
    }

    public function adminProducesManagement(Request $request)
    {
        $produces = Produces::paginate(10);
        $result = view('admin.producesManagement', [
            "produces" => $produces
        ]);
        $result = $this->producesOperation($request, $result);
        return $result;
    }

    public function adminMessage(Request $request)
    {
        $static = null;
        $result = view('admin.message');
        if ($request->isMethod('POST')) {
            $static = $this->messageHandler($request);
            $result = redirect('admin/message')->with('static', $static);
        }
        if (isset($request['id'])) {
            $ifReadyStatic = Message::find($request['id'])->ifReady;
            Message::find($request['id'])->update([
                'ifReady' => !$ifReadyStatic,
            ]);
        }
        return $result;
    }

    public function PersonalInfo(Request $request)
    {
        $error = null;
        $static = null;
        if ($request->isMethod('POST')) {
            $static = $this->personalInfoHandler($request);
        }
        return view('admin.personalinfo', [
            'error' => $error,
            'static' => $static
        ]);
    }

    public function adminPersonalInfo(Request $request)
    {
        $error = null;
        $static = null;
        if ($request->isMethod('POST')) {
            $static = $this->personalInfoHandler($request);
        }
        return view('admin.personalinfo', [
            'error' => $error,
            'static' => $static
        ]);
    }

    public function queryApi(Request $request)
    {
        $produces = Produces::where('title', 'like', '%' . $request['query'] . '%')->paginate(10);
        return new ProduceResource($produces);
    }

    public function queryUserApi(Request $request)
    {
        $user = User::where('id', $request['userid'])->first();
        return new UserResource($user);
    }

    public function messageCheckout($id)
    {
        $message = Message::where('id', $id)->first();
        $ifReadyStatic = Message::find($id)->ifReady;
        Message::find($id)->update([
            'ifReady' => !$ifReadyStatic,
        ]);
        return view('messageCheckout', [
            'message' => $message,
        ]);
    }

    public function messageHandler($request)
    {
        $message = Message::create([
            'senderId' => Auth::user()->id,
            'receiverId' => $request['receiverId'],
            'content' => $request['content'],
            'title' => $request['title'],
            'ifReady' => False,
        ]);
        if ($message) {
            return 'success';
        } else {
            return 'fail';
        }
    }

    public function personalInfoHandler($request)
    {
        $user = User::find(Auth::user()->id);
        $num = $user->update([
            'birthday' => $request['birthday'],
            'description' => $request['description'],
        ]);
        if ($num) {
            return 'success';
        } else {
            return 'false';
        }
    }

    public function producesOperation($request, $result)
    {
        $result = $result;
        if ($request->ajax()) {
            if (is_array($request['data'])) {
                $num = Produces::create([
                    'title' => $request["data"][0],
                    'description' => $request["data"][1],
                    'cover' => $request["data"][2],
                    'left' => intval($request["data"][3]),
                    'prices' => intval($request["data"][4]),
                    'userid' => Auth::User()->id
                ]);
                if ($num) {
                    $result = "success";
                } else {
                    $result = "fail";
                }
            } else if ($request['deleteId']) {
                $readyDelete = Produces::find(intval($request['deleteId']));
                $readyDelete->delete();
            } else {
                $readyUpdate = Produces::find(intval($request['id']));
                $num = $readyUpdate->update(
                    [$request['field'] => $request['data']]
                );
                if ($num == 1) {
                    $result = 'success';
                } else {
                    $result = 'fail';
                }
            }
        }
        return $result;
    }
}
