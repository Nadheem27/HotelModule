<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\User;
use App\RoomsAvail;
use App\Booking;
use Carbon\Carbon;

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
        $a = $request['check_in'];
        $b = $request['check_out'];
        $from = Carbon::parse($a);
        $to = Carbon::parse($b);
        $dates = [];
        for($d = $from; $d->lte($to); $d->addDay()) {
            $dates[] = $d->format('Y-m-d');
        }
        $a1 = RoomsAvail::whereDate('check_in','<=',$a)->whereDate('check_out','>=',$b)
            ->where('book_status',0)->first();
        $b1 = RoomsAvail::whereDate('check_in','<=',$a)->whereDate('check_out','>=',$b)
            ->where('book_status',1)->first();
        if(($a1 == '') && ($b1 == '')){
            return ['status' => 'error', 'data' => 'No Rooms Available on Selected Dates'];
        }       
        $avail_room = RoomsAvail::whereDate('check_in','<=',$a)->whereDate('check_out','>=',$b)
                                ->where('book_status',0)->pluck('room_number')->toArray();
        if($b1 != ''){
            $book_room = RoomsAvail::whereDate('check_in','<=',$a)->whereDate('check_out','>=',$b)
                                ->where('book_status',1)->get()->toArray();
            for($i=0;$i<count($book_room);$i++){
                $booked[] = Booking::where('booking_id',$book_room[$i]['booking_id'])->get()->toArray();            
            }
            for($j=0;$j<count($booked);$j++){
                for($k=0;$k<count($booked[$j]);$k++){
                    $date = explode('%',$booked[$j][$k]['booked_dates']);
                    if (array_intersect($date, $dates)) {
                        break;    
                    }else {
                        if($k == count($booked[$j])-1){
                            $avail_room[] = $booked[$j][$k]['room_number'];
                        }else{
                            continue;
                        }
                    }
                }                       
            }
        }
        if(!empty($avail_room)){
            return ['status' => 'success', 'data' => $avail_room];
        }else {
            return ['status' => 'error', 'data' => 'No Rooms Available on Selected Dates'];
        }
    }

    public function book(Request $request)
    {
        $from = Carbon::parse($request['check_in']);
        $to = Carbon::parse($request['check_out']);
        $dates = '';
        for($d = $from; $d->lte($to); $d->addDay()) {
            $dates = $dates.'%'.$d->format('Y-m-d');
        }
        try{
            $book = RoomsAvail::where('check_in','<=',$request['check_in'])->where('check_out','>=',$request['check_out'])
                                ->where('room_number',$request['room_number'])->first();
            $book->book_status = 1;
            $book->save();
            Booking::create([
                'booking_id' => $book->booking_id,
                'room_number' => $book->room_number,
                'booked_dates' => $dates,
                'created_at' => now()
            ]);
            $data = ['status' => 'SUCCESS', 'msg' => 'Room Booked Successfully !!'];
        }catch (Exception $e){
            $data = ['status' => 'ERROR', 'msg' => $e->getMessage()];
            } finally {
                Session::put('msg', $data);
                return redirect('/dashboard');
            }
    }
    
}
