<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sponsor;
use DB;

class SponsorsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors =  Sponsor::all() ;
        return view('sponsors.index')->with('sponsors',$sponsors);
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
        $input = $request->all();
        $date = strtotime($input['startdate']); 
        $input['startdate']  =  date('Y-m-d', $date);
        Sponsor::create($input);
       
       return back()->withSuccessMessage('Successfully Added');
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
        $sponsor=  Sponsor::find($id) ;
        return view('sponsors.editsponsor', compact('sponsor'));
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
        $input = $request->all();
        $sponsor =  Sponsor::find($id) ;
        $sponsor ->sponsornames = $input['sponsornames'];
        $sponsor ->contactperson = $input['contactperson'];
        $sponsor ->phone = $input['phone'];
        $sponsor ->email = $input['email'];
        $sponsor ->address = $input['address'];
        
        $sponsor->save();
        return redirect()->action(
            'SponsorsController@index'
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sponsor::where('sponsor_id',$id)->delete();
        return redirect()->action(
            'SponsorsController@index'
        );
    }
}
