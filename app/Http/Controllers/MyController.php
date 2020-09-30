<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Sponsor;
use App\Project;
use App\Votehead;

use PDF;
use DB;


class MyController extends Controller
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
       
        //get details of all projects
        $projects =  array();
        $projectdetils =  Project::all()->where('cur_status', '=', 'Active');
        
        $projectdetils2 =  Project::all()
        ->where('cur_status', '!=', 'Complete');
        //->where('TIMESTAMPDIFF(DAY,NOW() , deadline)', '<', '90');

        
        //this section checks the number of all active projects
        $countprojects =  DB::table('projects')
            ->select(DB::raw('COUNT(*) AS total'))
            ->where('cur_status', '=', 'Active')
            ->get();
    
            $ongoingprojects = 0 ;
            foreach ($countprojects as $totald){ 
                $ongoingprojects = $totald->total;
            }


            //get budgets
            $budgets =  DB::table('projects')
            ->select(DB::raw('sum(budget) AS total'))
            ->where('cur_status', '=', 'Active')
            ->get();
    
            $totalbudget = 0 ;
            foreach ($budgets as $totald){ 
                $totalbudget = $totald->total;
            }


        $projects['activeprojects'] = $ongoingprojects;
        $projects['totalbudget'] = $totalbudget;


        //This section gets the number of completed projects

        $completed =  DB::table('projects')
            ->select(DB::raw('COUNT(*) AS total'))
            ->where('cur_status', '=', 'Complete')
            ->get();
    
            $completedprojects = 0 ;
            foreach ($completed as $totald){ 
                $completedprojects = $totald->total;
            }
        $projects['completedprojects'] = $completedprojects;



        //get total budget expenditure per project
        $voteheadtotals =  DB::table('disbursment_news')
        ->join('projects', 'disbursment_news.project_id', '=', 'projects.project_id')
        ->select(DB::raw('SUM(debit) AS total'))
        ->where('cur_status', '=', 'Active')
        ->get();

        
        foreach ($voteheadtotals as $totald){ 
            $projects['totalused'] =  $totald->total;
        }

        //get total budget expenditure per project
        $voteheadtotals =  DB::table('disbursment_news')
        ->select(DB::raw('project_id, SUM(debit) AS total'))
        ->groupBy('project_id')
        ->get();

        $mytotals = array();
        foreach ($voteheadtotals as $totald){ 
            $val = $totald->project_id;
            $mytotals[$val] =  $totald->total;
        }


        return view('home', compact('projects','projectdetils','mytotals','projectdetils2'));
    }

    public function test()
    {
        return view('testhome');
    }

    
    
    
}
