<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRequests;
use App\Models\Checks;
use DateTime;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DCManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function requestForm(){
        return view('dc-manager.requestform');
    }

    public function requests(){
        return view('dc-manager.requests')->with('requests', AccessRequests::orderBy('id', 'DESC')->get());
    }

    public function index()
    {
        $requests = count(AccessRequests::all());
        $this_monthAR = count(AccessRequests::whereMonth('created_at', '=', Carbon::now()->month)->get());
        $last_monthAR = count(AccessRequests::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get());
        $request_report = round(($this_monthAR / $requests) * 100 - ($last_monthAR / $requests) * 100);

        $confirmed_requests = count(AccessRequests::where('is_confirmed', 1)->get());
        $this_monthRC = count(AccessRequests::where('is_confirmed', 1)->whereMonth('created_at', '=', Carbon::now()->month)->get());
        $last_monthRC = count(AccessRequests::where('is_confirmed', 1)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get());
        $confirmation_report = round(($this_monthRC / $confirmed_requests) * 100 - ($last_monthRC / $confirmed_requests) * 100);

        $approved_requests = count(AccessRequests::where('is_approved', 1)->get());
        $this_monthRA = count(AccessRequests::where('is_approved', 1)->whereMonth('created_at', '=', Carbon::now()->month)->get());
        $last_monthRA = count(AccessRequests::where('is_approved', 1)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get());
        $approval_report = round(($this_monthRA / $approved_requests) * 100 - ($last_monthRA / $approved_requests) * 100);
        
        $visited_requests = count(Checks::all());
        $this_monthVR = count(Checks::whereMonth('created_at', '=', Carbon::now()->month)->get());
        $last_monthVR= count(Checks::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get());
        $visit_report = round(($this_monthVR / $visited_requests) * 100 - ($last_monthVR / $visited_requests) * 100);

        $requests_per_month = array();
        for ($i=1; $i < 13; $i++) { 
            $request_in_this_month = count(AccessRequests::whereRaw('MONTH(created_at) = ?', $i)->get());
            array_push($requests_per_month, $request_in_this_month);
        }
        
        return view('dc-manager.index')
                    ->with('requests', $requests)
                    ->with('request_report', $request_report)
                    ->with('confirmation_report', $confirmation_report)
                    ->with('approval_report', $approval_report)
                    ->with('visited_requests', $visited_requests)
                    ->with('visit_report', $visit_report)
                    ->with('confirmed', AccessRequests::where('is_confirmed', '=', '1')->count())
                    ->with('approved', AccessRequests::where('is_approved', '=', '1')->count())
                    ->with('infra', AccessRequests::where('unit', '=', '03')->count())
                    ->with('sdc', AccessRequests::where('unit', '=', '04')->count())
                    ->with('security', AccessRequests::where('unit', '=', '06')->count())
                    ->with('operation', AccessRequests::where('unit', '=', '05')->count())
                    ->with('analysis', AccessRequests::where('unit', '=', '01')->count())
                    ->with('infoman', AccessRequests::where('unit', '=', '02')->count())
                    ->with('chartdata', $requests_per_month);
    }

    public function showProfile(){
        return view('dc-manager.my-profile');
    }

    public function updateProfile(){
        return null;
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'newpassword' => 'required|min:6',
            'repassword' => 'required|min:6',
        ]);
        if($request->newpassword === $request->repassword){
            $update = User::where('email', $request->email)->update([
                'password' => Hash::make($request->newpassword)
            ]);
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $origin = new DateTime('2009-10-11');
        // $target = new DateTime('2009-12-06');
        // $interval = $origin->diff($target);
        // echo $interval->format('%R%a days');
        // echo implode(" ", $request->accesstime);
        // $num = mt_rand(1000,9999);
        // echo $num;
        // $days = $request->enddate-$request->startdate;
        
        // $letter = $request->file('letter');
        // $letter = $letter->getClientOriginalName().time();

        //visiting days
        $startdate = new DateTime(str_replace("/","-",$request->startdate));
        $enddate = new DateTime(str_replace("/","-",$request->enddate));
        $interval = $startdate->diff($enddate);
        $interval = $interval->format('%R%a days');
        $days = str_replace('+', '', $interval);
        $days = str_replace('days', '', $days);

        //remaining days
        $today = new DateTime(date('Y-m-d'));
        $remaining_days = $today->diff($enddate);
        $remaining_days = $remaining_days->format('%R%a days');
        $remaining_days = str_replace('days', '', $remaining_days);
        
        if($remaining_days > 0){
            $remaining_days = $days;
        }
        else if($remaining_days < 0){
            $remaining_days = $today->diff($enddate);
            $remaining_days = $remaining_days->format('%R%a days');
            $remaining_days = str_replace('days', '', $remaining_days);
        }

        // echo $days;
        $personnel4 = $request['personnel4'];
        $personnel5 = $request['personnel5'];
        $personnel6 = $request['personnel6'];
        $personnel7 = $request['personnel7'];
        $personnel8 = $request['personnel8'];
        $personnel9 = $request['personnel9'];
        $personnel10 = $request['personnel10'];

        // dd($request->all());
        // $req_no = 1;
        // $req_id = date('d').date('m').substr(date('Y'), 2).$unit.mt_rand(1000,9999);
        // echo $req_id;
        // $this->validate($request, [
        //     'fullname' => 'required',
        //     'phonenumber' => 'required|startswith:9',
        //     'idnumber' => 'required',
        //     'startdate' => 'required',
        //     'enddate' => 'required',
        //     'accessrequiredto' => 'required',
        //     'accesstime' => 'required',
        //     'location' => 'required',
        //     'areastobeaccessed' => 'required',
        //     'personnel1' => 'required',
        //     'personnel2' => 'required',
        //     'personnel3' => 'required',
        //     'personnel4' => 'required',
        //     'impact' => 'required',
        //     'purpose' => 'required',
        // ]);

        switch ($request->unit) {
            case 'Infratructure Management':
                $unit = '03';                
                break;
            case 'IS Application Management and Customization':
                $unit = '04';      
                break;
            case 'IS Security':
                $unit = '06';                                         
                break;
            case 'IS Operations and BC/DR Management':
                $unit = '05';
                break;
            case 'Business Analysis and IS PMO':
                $unit = '01';
                break;
            case 'Information Management':
                $unit = '02';
                break;
            default:
                //
                break;
        }
        

        $requestno = date('d').date('m').substr(date('Y'), 2).$request->idnumber.mt_rand(1000, 9999);
        
        $access_request = AccessRequests::create([
            'fullname' => $request->fullname ,
            'requestno' => date('d').date('m').substr(date('Y'), 2).$request->idnumber.mt_rand(1000, 9999),
            'phone_number' => $request->phonenumber,
            'email' => $request->email,
            'id_number' => $request->idnumber,
            'unit' => (string)$unit,
            'date' => date('Y-m-d h:m:s'),
            'starting_date' => $request->startdate,
            'end_date' => $request->enddate,
            'visiting_days' => $days,
            'remaining_days' => $remaining_days,
            'addis_ababa_branch' => 'null',
            'kera_gofa_branch' => 'null',
            'access_time' => 'null',
            'personnel1' => $request->personnel1,
            'personnel2' => $request->personnel2,
            'personnel3' => $request->personnel3,
            'personnel4' => $personnel4,
            'personnel5' => $personnel5,
            'personnel6' => $personnel6,
            'personnel7' => $personnel7,
            'personnel8' => $personnel8,
            'personnel9' => $personnel9,
            'personnel10' => $personnel10,
            'escortingteam' => $request->escortingteam,
            'escorts' => $request->escorts,
            'location' => 'null',
            'status' => 1,
            'is_confirmed' => 1,
            'impact' => 'null',
            'denial_reason' => 'null',
            'rejection_reason' => 'null',
            'purpose' => 'null',            
        ]);

        $requestno = AccessRequests::latest()->first();
        // $message = "Hello, there is a new access request waiting for confirmation with request number: " . $requestno;
        
        // Mail::to('abenezerkifle@cbe.com.et')->send(new RequestNotification($message));

        return view('dc-manager.next-form-page')->with('requestno', $requestno['requestno']);
    }

    public function nextStore(Request $request)
    {
        // $this->validate($request, [
        //     'fullname' => 'required',
        //     'phonenumber' => 'required',
        //     'idnumber' => 'required',
        //     'startdate' => 'required',
        //     'enddate' => 'required',
        //     'accessrequiredto' => 'required',
        //     'accesstime' => 'required',
        //     'location' => 'required',
        //     'areastobeaccessed' => 'required',
        //     'personnel1' => 'required',
        //     'personnel2' => 'required',
        //     'personnel3' => 'required',
        //     'personnel4' => 'required',
        //     'impact' => 'required',
        //     'purpose' => 'required'
        // ]);

        
        // dd($request->all());
        $access_request = AccessRequests::where('requestno', $request->requestno)->update([
            'addis_ababa_branch' => implode(", ", $request->areastobeaccessed1),
            'kera_gofa_branch' => implode(", ", $request->areastobeaccessed2),
            'access_time' => implode(", ", $request->accesstime),
            'location' => $request->location,
            'impact' => $request->impact,
            'purpose' => $request->purpose,
        ]);

        // $message = "Hello, there is a new access request waiting for confirmation with request number: " . $requestno;
        
        // Mail::to('abenezerkifle@cbe.com.et')->send(new RequestNotification($message));

        // session()->flash('message', 'Access Request has been successfully submitted.');

        return redirect()->route('all-requests-dc-man');
    }

    //revoke a request
    public function revokeRequest(Request $request){
        // dd($request->all());
        $revoke_request = AccessRequests::where('requestno', $request->revoke);
        $revoke_request->delete();
        $request->session()->flash('alert-success', 'Request is deleted successfully.');
        return redirect()->route('all-requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function requestDetails($requestno){
        $enddate = AccessRequests::where('requestno', $requestno)->pluck('end_date');
        $startdate = AccessRequests::where('requestno', $requestno)->pluck('starting_date');

        $enddate = str_replace('[', '', $enddate);
        $enddate = str_replace(']', '', $enddate);
        $enddate = str_replace('\\', '', $enddate);
        $enddate = str_replace('"', '', $enddate);
        $enddate = str_replace('/', '-', $enddate);

        $startdate = str_replace('[', '', $startdate);
        $startdate = str_replace(']', '', $startdate);
        $startdate = str_replace('\\', '', $startdate);
        $startdate = str_replace('"', '', $startdate);
        $startdate = str_replace('/', '-', $startdate);

        $startdate = new DateTime($startdate);
        $enddate = new DateTime($enddate);
        
        $interval = $startdate->diff($enddate);
        $interval = $interval->format('%R%a days');
        $visiting_days = str_replace('+', '', $interval);
        $visiting_days = str_replace('days', '', $visiting_days);

        $today = new DateTime(date('Y-m-d'));
        $remaining_days = $today->diff($enddate);
        $remaining_days = $remaining_days->format('%R%a days');
        $remaining_days = str_replace('days', '', $remaining_days);
        $remaining_days = (int)$remaining_days+0;
        
        // echo $remaining_days;
        if($remaining_days > $visiting_days){
            $remaining_days = $visiting_days;
        }
        
        $access_request = AccessRequests::where('requestno', '=', $requestno)->first()->update(['remaining_days' => $remaining_days]);
        //what to do if remaining days are less than zero?
        if($remaining_days < 0){
            $access_request = AccessRequests::where('requestno', '=', $requestno)->first()->update(['remaining_days' => 0, 'status' => 5]);
        }
        $request = AccessRequests::where('requestno', '=', $requestno)->first();
        return view('dc-manager.requestdetail')->with('request', $request);
    }

    public function confirmRequest(Request $request){
        $confirmation = AccessRequests::where('requestno', $request->is_confirmed)->update(['status' => 1, 'is_confirmed' => 1]);
        return redirect()->back();
    }

    public function denyRequest(Request $request){
        $deny = AccessRequests::where('requestno', $request->is_denied)->update(['is_denied' => 1, 'status' => 2, 'denial_reason' => $request->denial_reason]);
        return redirect()->back();
    }

    public function visitReport(Request $request){
        $report = Checks::orderBy('requestno', 'DESC')->get();
        return view('dc-manager.visiting-report')->with('checks_report', $report);
    }
}
