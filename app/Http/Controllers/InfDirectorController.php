<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRequests;
use App\Models\LogBook;
use App\Models\LogBook2;
use Illuminate\Support\Carbon;
use App\Models\Checks;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DateTime;

class InfDirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function requests(){
        $requests = AccessRequests::where('is_confirmed', '=', '1')->orderBy('id', 'DESC')->get();
        return view('inf-manager.requests-confirmed')->with('requests', $requests);
    }

    public function requestForm(){
        return view('inf-manager.requestform');
    }

    public function permanentVisitors(){
        return view('inf-manager.permanent-visitors');
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
        
        return view('inf-manager.index')
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
        //
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
        // remaining days is equal to enddate minus today
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
        
        
        if($remaining_days > $visiting_days){
            $remaining_days = $visiting_days;
        }
        
        $access_request = AccessRequests::where('requestno', '=', $requestno)->first()->update(['remaining_days' => $remaining_days]); //pending???
        //what to do if remaining days are less than zero?
        if($remaining_days < 0){
            $access_request = AccessRequests::where('requestno', '=', $requestno)->first()->update(['status' => 5]);
            $access_request = AccessRequests::where('requestno', '=', $requestno)->first()->update(['remaining_days' => 0]);
        }
        
        $request = AccessRequests::where('requestno', '=', $requestno)->first();
        return view('inf-manager.requestdetail')->with('request', $request);
    }

    public function approveRequest(Request $request){
        //updating the status of the request to approved
        //$approve = AccessRequests::where('requestno', $request->is_approved)->first();
        
        
        // echo $newDate;
        $approve = AccessRequests::where('requestno', $request->is_approved)->update(['is_approved' => 1, 'status' => 3]);
        $approve = AccessRequests::where('requestno', $request->is_approved)->first();

        
        //populate the logbook with initial values
        //first get the number of visiting days and initialize the logbook with it
        $counter = 0;
        while ($counter < $approve->visiting_days) {
            $newDate = str_replace('/', '-', $approve->starting_date);
            $newDate = date('Y-m-d', strtotime($newDate));
            $newDate = date("d/m/Y", strtotime($newDate. "+" . $counter . " day"));
            
            $access_request = LogBook::create([
                'requestno' => $request->is_approved,
                'admin_name' => '',
                'visiting_date' => $newDate,
                'morning_start' => '',
                'morning_end' => '',
                'afternoon_start' => '',
                'afternoon_end' => '',
                'personnels' => '',
            ]);
            $access_request = LogBook2::create([
                'requestno' => $request->is_approved,
                'admin_name' => '',
                'visiting_date' => $newDate,
                'morning_start' => '',
                'morning_end' => '',
                'afternoon_start' => '',
                'afternoon_end' => '',
                'personnels' => '',
            ]);
            
           $counter++;
        }
        
        return redirect()->back();
    }

    public function rejectRequest(Request $request){
        $deny = AccessRequests::where('requestno', $request->is_rejected)->update(['is_rejected' => 1, 'status' => 4, 'rejection_reason' => $request->rejection_reason]);
        return redirect()->back();
    }

    public function showProfile(){
        return view('inf-manager.my-profile');
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
}
