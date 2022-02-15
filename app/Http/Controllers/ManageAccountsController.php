<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\RequestNotification;
use Illuminate\Support\Facades\Mail;

class ManageAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function resetPassword(){
        return view('admin.reset-password')->with('users', User::all());
    }
    
    public function reset(Request $request){
        // $this->validate($request, [
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        
        // dd($request->all());
        $access_request = User::where('email', $request->email)->update([
            'password' => $request->password,
            'isActive' => 1,
        ]);

        // $message = "Hello, your account password has been reset to 'password'. You can change this password.";
        
        // Mail::to($request->email)->send(new RequestNotification($message));

        return redirect()->back();
    }

    public function removeAccount(){
        return view('admin.remove-account')->with('users', User::all());
    }

    public function suspendAccount(Request $request){
        // $message = "Hello, your account has been suspended. Contact the system admin for more details";        
        // Mail::to('abenezerkifile@cbe.com.et')->send(new RequestNotification($message));

        $suspend = User::where('email', $request->email)->update(['isActive' => 0]);
        return redirect()->back();
    }

    public function restoreAccount(Request $request){
        $suspend = User::where('email', $request->email)->update(['isActive' => 1]);
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
