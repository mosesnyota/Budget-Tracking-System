<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activities;

class ActivitiesController extends Controller
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
        $input = $request->all();
        $input['start_date']  =  date('Y-m-d', strtotime($input['start_date']));
        $input['deadline_date']  =  date('Y-m-d', strtotime($input['deadline_date']));
        Activities::create($input);
        if(session('success_message')) {
                Alert::success('Success', 'Created Successfully');
        }
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
        $input = $request->all();
        $myid = $input['userId'];
        $date = strtotime($input['activityenddate']);    
        $Activity = Activities::find($myid);
        
        $Activity->completion_date = date('Y-m-d', $date);
        $Activity->cur_status = $input['curstatus'];
        
        $Activity->save();
        if(session('success_message')) {
            Alert::success('Success', 'Projects Successfully Saved');
        }
        return redirect()->action(
            'ProjectsController@index'
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
        //
    }
}
