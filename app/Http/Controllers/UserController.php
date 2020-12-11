<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\User;
use App\RoomsAvail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = $request->validate([
            'user_name' => 'required | alpha_dash | min:3',
            'user_email' => 'required | email',
            'password' => 'required | min:8 | max:50 |confirmed ',
            'user_address' => 'required | alpha_dash',
            'user_phone' => 'required | numeric | regex:/[0-9]{10}/',
        ]);
        $e = User::where('email', $request['user_email'])->first();
        $p = User::where('phone_number', $request['user_phone'])->first();        
        if(!empty($e))
        {
            Session::flash('email_error', 'Email Already Registered');
            return redirect()->back()->withInput($request->input());
        }
        if(!empty($p))
        {
            Session::flash('phone_error', 'Phone Number Already Registered');
            return redirect()->back()->withInput($request->input());
        }       
        $this->registerdata($request);
        return redirect('/login');
    }

    public function registerdata($request)
    {
        try{
            User::create([
                'name' => $request['user_name'],
                'email' => $request['user_email'],
                'phone_number' => $request['user_phone'],
                'password' => Hash::make($request['password']),
                'role' => '1',
                'created_at' => now(),
                'address' => $request['user_address'],
            ]);

            $data = ['status' => 'SUCCESS', 'msg' => 'Successfully Registered Login here !!'];
        }catch (Exception $e){
            $data = ['status' => 'ERROR', 'msg' => $e->getMessage()];
            } finally {
                Session::put('msg', $data);
                return true;
            }
    }

    public function phone(Request $request)
    {
        $p = User::where('phone_number', $request['phone'])->first();
        if(!empty($p))
        {
            return "Phone Number Already Registered";
        }
    }

    public function email(Request $request)
    {
        $e = User::where('email', $request['email'])->first();
        if(!empty($e))
        {
            return "Email Already Registered";
        }
    }

    public function index()
    {
        return view('home');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }

    public function room(Request $request)
    {
        $room = RoomsAvail::where('avail_date',$request['date'])->where('book_status',0)->pluck('room_number');
        if(!empty($room->first()))
        {
            return ['status' => 'success', 'data' => $room];
        }else{
            return ['status' => 'error', 'data' => 'No Rooms available on selected date'];
        }
    }

    public function book(Request $request)
    {
        try{
            $book = RoomsAvail::where('avail_date',$request['avail_date'])->where('room_number',$request['room_number'])->first();
            $book->book_status = 1;
            $book->booked_by = Auth::user()['user_id'];
            $book->booked_time = now();
            $book->save();
            $data = ['status' => 'SUCCESS', 'msg' => 'Room Booked Successfully !!'];
        }catch (Exception $e){
            $data = ['status' => 'ERROR', 'msg' => $e->getMessage()];
            } finally {
                Session::put('msg', $data);
                return redirect('/dashboard');
            }
    }
}
