<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use App\User;
use App\HotelLogin;
use App\Rooms;
use App\RoomsAvail;

class HotelController extends Controller
{
    public function date()
    {
        return today()->format('Y-m-d');
    }

    public function table()
    {
        $room_data = Rooms::where('record_status',1)->get()->toArray();
        return view('hotel-dashboard')->with('room_data',$room_data);
    }

    public function index(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required | email',
            'password' => 'required '
        ]);
        if(Auth::guard('hotel')->attempt(['email' => $request['email'], 'password' => $request['password']]))
        {
            return redirect('/hotel-dashboard');
        }else{
            Session::flash('error_hotel', 'These Credentials do not match our Records !!');
            return redirect()->back()->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::guard('hotel')->logout();
        return redirect('/hotel-login');
    }

    public function check()
    {
        if(!empty(Auth::guard('hotel')->user()))
        {
            return redirect('/hotel-dashboard');
        } return view('hotel-login');
    }

    public function newroom(Request $request)
    {
        $validator = $request->validate([
            'room_number' => 'required | alpha_dash ',
            'floor_number' => 'required | numeric | digits:2',
            'bed_count' => 'required | numeric | digits:2'
        ]);
        $r = Rooms::where('room_number',strtoupper($request['room_number']))->first();
        if(!empty($r)){
            Session::flash('room_error','Room Number Already Registered');
            return redirect()->back()->withInput($request->all());
        }
        try{
            Rooms::create([
                'room_number' => strtoupper($request['room_number']),
                'floor' => $request['floor_number'],
                'beds' => $request['bed_count'],
                'record_status' => 1,
                'created_at' => now()
            ]);
        $data = ['status' => 'SUCCESS !!', 'msg' => ' Record Inserted Successfully'];

        } catch(Exception $e) {
            $data = ['status' => 'ERROR', 'msg' => $e->getMessage()];
            }finally {
                Session::put('msg', $data);
                return redirect('/hotel-dashboard');
            }
    }

    public function delete(Request $request)
    {
        try{
            $delete = Rooms::findOrFail($request['room']);
            $delete->record_status = 0;
            $delete->save();

            $data = ['status' => 'SUCCESS !!', 'msg' => ' Record Deleted Successfully'];
        } catch(Exception $e) {
            $data = ['status' => 'ERROR', 'msg' => $e->getMessage()];
            }finally {
                Session::put('msg', $data);
                return 'Deleted';
            }
    }

    public function availablity()
    {
        $room_drop =  Rooms::where('record_status',1)->select('room_number')->get()->toArray();
        $book_data = RoomsAvail::where('avail_date','>',$this->date())->get()->toArray();
        return view('room-availability')->with('room_drop',$room_drop)->with('book_data',$book_data);
    }

    public function newavail(Request $request)
    {
        $validator = $request->validate([
            'room_number' => 'required',
            'avail_date' => 'required'
        ]);
        if($request['avail_date'] < $this->date()){
            Session::flash('date_error','Please Select Future dates');
            return redirect()->back();
        }
        $rd = RoomsAvail::where('room_number',$request['room_number'])->where('avail_date',$request['avail_date'])->first();
        if(!empty($rd)){
            $data = ['status' => 'Duplicate Record', 'msg' => 'Record Already Registered'];
            Session::put('msg',$data);
            return redirect()->back();
        }else {
            $this->insert($request);
            return redirect('/availablity-check');
        }        
    }

    public function insert($request)
    {
        try{
            RoomsAvail::create([
                'room_number' => $request['room_number'],
                'avail_date' => $request['avail_date'],
                'book_status' => 0,
                'created_at' => now()
            ]);
            $data = ['status' => 'SUCCESS !!', 'msg' => ' Record Inserted Successfully'];

        } catch(Exception $e) {
            $data = ['status' => 'ERROR', 'msg' => $e->getMessage()];
            }finally {
                Session::put('msg', $data);
                return true;                
            }
    }

    public static function getusername($id)
    {
        return User::where('user_id',$id)->pluck('name')->first();
    }
}
