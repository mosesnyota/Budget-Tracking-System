<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use SweetAlert;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;
class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $user = Auth::user();
        $userid = $user->id;
        $passwd = $user->password;
        $input = $request->all();

        $oldpass = $input['oldpassword'];
        $newpassword = $input['newpassword'];
        $confirmedpassword = $input['confirmedpassword'];

        if($newpassword != $confirmedpassword){
            alert()->error('Oops...!', 'The New Password Confirmation does not match');
            return Redirect::back()->withErrors(['msg', 'The New Password Confirmation does not match']);
        }else if (Hash::check($request->oldpassword, $passwd)) {
            alert()->error('Oops...!', 'Wrong Old Password');
            return Redirect::back()->withErrors('Wrong Old Password');
        }else{
            $user->password = Hash::make($request->newpassword);
            $user->save();
            alert()->success('Success!', 'Successfully Changed');
            return back()->withSuccessMessage('Successfully Changed');
        }


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
