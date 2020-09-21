<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funding;
use App\Sponsor;

class FundingController extends Controller
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
        $fundings =  Funding::all() ;
        $sponsors = Sponsor::all();
        return view('funds.index',compact('fundings','sponsors'));
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
        $final_amount = $input['original_amount']  * $input['exchangerate']  ;
        $input['final_amount']  = $final_amount ;
        $input['funding_date']  =  date('Y-m-d', strtotime($input['funding_date']));
        Funding::create($input);
        alert()->success('Success', 'Created Successfully');
      
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
        $funding = Funding::find($id) ;
        $sponsors = Sponsor::all();
        $funding->funding_date = date('m/d/Y', strtotime( $funding->funding_date));
        return view('funds.editfunds',compact('funding','sponsors'));
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
        $funding = Funding::find($id) ;
        $input = $request->all();
        $final_amount = $input['original_amount']  * $input['exchangerate']  ;
        $input['final_amount']  = $final_amount ;
    
        $funding ->sponsor_id = $input['sponsor_id'];
        $funding ->funding_date = date('Y-m-d', strtotime($input['funding_date']));
        $funding ->currency = $input['currency'];
        $funding ->original_amount = $input['original_amount'];
        $funding ->exchangerate = $input['exchangerate'];
        $funding ->final_amount =  $final_amount ;
        $funding->save();
        alert()->success('Success', 'Created Successfully');
      
        return redirect()->action(
            'FundingController@index'
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
        Funding::where('funding_id',$id)->delete();
        return back();
    }
}
