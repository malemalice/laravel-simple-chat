<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Redirect;
use App\StatusModel;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

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
      $data = [
        'formAction'=>url('processStatus'),
        'status'    => StatusModel::data()->orderBy('created_at','desc')
      ];
        return view('home',$data);
    }

    public function profile(Request $request)
    {
      $data = [
        // 'formAction'=>url('processStatus'),
        'data'    => User::find($request->user()->id)
      ];
        return view('auth.profile',$data);
    }

    public function updateProfile(Request $request){
      $user = User::find($request->user()->id);
      $input = $request->all();
      $rules = [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255',
          'password' => 'min:6|confirmed',
        ];

        $message = [
          'name.required' => 'Name must be filled',
          'email.required' => 'Email must be filled',
        ];
      $validator = Validator::make($input, $rules, $message);
      if ($validator->fails()) {
        return redirect('/profile')
                        ->withErrors($validator)
                        ->withInput();
        //  return $validator->errors()->all();
        // dd($validator->messages());
            // return response()->json($validator->messages(), 422);
            // return response()
            // ->view('auth.profile', $validator->messages());
            // ->header('Content-Type', $type);
            // return view('auth.profile',$validator->messages());
        } else {
          if(!empty($request->password) && ($request->password==$request->password_confirmation)){
            $input['password'] = bcrypt($request->password);
          }

          $user->update($input);
          return redirect('/profile')->with('status', 'Profile updated!');
          // return response()->json(['msg'=>'Success']);

        }
    }

    public function update(Request $request)
    {
      $stat = StatusModel::create(['status'=>$request->status,'user_id'=>$request->user()->id]);
      return response()->json(['msg'=>'Success']);
    }
}
