<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessRequests;
use Illuminate\Support\Carbon;
use App\Models\Checks;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        
        return view('admin.index')
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
}
