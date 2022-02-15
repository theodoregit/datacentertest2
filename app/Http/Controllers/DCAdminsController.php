<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRequests;
use App\Models\LogBook;
use App\Models\LogBook2;
use App\Models\Checks;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DateTime;

class DCAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function requests(){
        $approved_requests = AccessRequests::where('is_approved', 1)->where('status', '!=', 5)->orderBy('id', 'DESC')->get();
        return view('dc-admins.requests')->with('approved_requests', $approved_requests);
    }

    public function requestForm(){
        return view('dc-admins.request-form-dc-admin');
    } 

    public function trackRequest($requestno){
        $request = AccessRequests::where('requestno', '=', $requestno)->first();
        $track = LogBook::where('requestno', '=', $requestno)->where('visiting_date', '=', date('d/m/Y'))->first();
        // dd($request->all());
        $starting_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->starting_date)));
        $end_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->end_date)));
        $today = (date('Y-m-d'));

        $interval = (new DateTime($starting_date))->diff(new DateTime($today));
        $interval = $interval->format('%R%a days');
        $diffs = str_replace('+', '', $interval);
        $diffs = str_replace('days', '', $diffs);

        $interval = (new DateTime($end_date))->diff(new DateTime($today));
        $interval = $interval->format('%R%a days');
        $diffe = str_replace('+', '', $interval);
        $diffe = str_replace('days', '', $diffe);


        //store each personnels in an array
        $personnels = array($request['personnel1'], $request['personnel2'], $request['personnel3'], $request['personnel4'], $request['personnel5'], 
                            $request['personnel6'], $request['personnel7'], $request['personnel8'], $request['personnel9'], $request['personnel10']);
        $personnels = array_filter($personnels);
        $checks = Checks::where('requestno', $requestno)->get();
        return view('dc-admins.track-requests')->with('track_request', $request)
                                                ->with('checks', $checks)
                                                ->with('track', $track)
                                                ->with('personnels', $personnels)
                                                ->with('starting_date', $starting_date)
                                                ->with('today', $today)
                                                ->with('diffs', $diffs)
                                                ->with('diffe', $diffe);
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
        return view('dc-admins.requestdetails')->with('approved_requests', $request);
    }

    public function track(Request $request){
        
        $this->validate($request, [
            'checkin' => 'required',
            'location' => 'required',
            'personnels' => 'required',
        ]);

        
        //either save or submit
        if($request->location == '1'){
            switch ($request->submitiontype) {
                case 'save':
                    //updates the logbook
                    $logbook = LogBook::where('requestno', $request->requestno)->where('visiting_date', date('d/m/Y'))->update([
                        'admin_name' => $request->admin_name,
                        'morning_start' => $request->morning_start,
                        'morning_end' => $request->morning_end,
                        'afternoon_start' => $request->afternoon_start,
                        'afternoon_end' => $request->afternoon_end,
                        'personnels' =>  implode(", ", $request->personnels),
                        ]);
                    //record the check-ins and outs
                    $checks = Checks::create([
                        'requestno' => $request->requestno,
                        'admin' => $request->admin_name,
                        'date' => date('d/m/Y'),
                        'location' => $request->location,
                        'checkedin' => $request->checkin,
                        'checkedout' => $request->checkout,
                        'personnels' =>  implode(", ", $request->personnels),
                    ]);
                    break;
                case 'submit':
                    echo "this is submit";
                    break;
                default:
                    //
                    break;
            }
        }
        elseif($request->location == '2'){
            switch ($request->submitiontype) {
                case 'save':
                    $logbook = LogBook2::where('requestno', $request->requestno)->where('visiting_date', date('d/m/Y'))->update([
                        'admin_name' => $request->admin_name,
                        'morning_start' => $request->morning_start,
                        'morning_end' => $request->morning_end,
                        'afternoon_start' => $request->afternoon_start,
                        'afternoon_end' => $request->afternoon_end,
                        'personnels' =>  implode(", ", $request->personnels),
                        ]);
                    $checks = Checks::create([
                        'requestno' => $request->requestno,
                        'date' => date('d/m/Y'),
                        'location' => $request->location,
                        'checkedin' => $request->checkin,
                        'checkedout' => $request->checkout,
                        'personnels' =>  implode(", ", $request->personnels),
                    ]);
                    break;
                case 'submit':
                    echo "this is submit";
                    break;
                default:
                    //
                    break;
            }
        }
        // switch ($request->submitiontype) {
        //     case 'save':
        //         $logbook = LogBook::where('requestno', $request->requestno)->where('visiting_date', date('d/m/Y'))->update([
        //             'admin_name' => $request->admin_name,
        //             'location' => $request->location,
        //             'morning_start' => $request->morning_start,
        //             'morning_end' => $request->morning_end,
        //             'afternoon_start' => $request->afternoon_start,
        //             'afternoon_end' => $request->afternoon_end,
        //             'personnels' =>  implode(", ", $request->personnels),
        //             ]);
        //         break;
        //     case 'submit':
        //         echo "this is submit";
        //         break;
        //     default:
        //         //
        //         break;
        // }

        return redirect()->back();
    }

    public function updateTrackCheck(Request $request){
        $this->validate($request, [
            'checkoutupdate' => 'required',
        ]);

        $logbook = Checks::where('created_at', $request->created_at)
                         ->update([
                                    'checkedout' => $request->checkoutupdate,
                                ]);

        return redirect()->back();
    }

    public function screen(){
        $approved_requests = AccessRequests::where('is_approved', 1)->where('status', '!=', 5)->orderBy('date', 'DESC')->get();
        return view('dc-admins.reception-screen')->with('requests', $approved_requests);
    }

    public function showProfile(){
        return view('dc-admins.my-profile');
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
    
    public function index()
    {
        //
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
}
