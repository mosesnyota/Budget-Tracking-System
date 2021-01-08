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
        $projectdetils =  Project::where('cur_status', '=', 'Active')->orderByRaw('start_date DESC')->skip(0)->take(5)->get();
        
        $projectdetils2 =  Project::where('cur_status', '!=', 'Complete')
        ->whereRaw('TIMESTAMPDIFF(DAY,NOW() , deadline) < 90 ' )->skip(0)->take(5)->orderByRaw('TIMESTAMPDIFF(DAY,NOW() , deadline) ASC')->get();

        
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


        $year0 = date('Y');
        $year1 = date('Y') - 1;
        $year2 = date('Y') - 2;
        $year3 = date('Y') - 3;

        $incomePerYear = [];
        $incomePerYear[$year0] =  0 ;
        $incomePerYear[$year1] =  0 ;
        $incomePerYear[$year2] =  0 ;
        $incomePerYear[$year3] =  0 ;


        $expensesPerYear = [];
        $expensesPerYear[ $year0] = 0;
        $expensesPerYear[ $year1] = 0;
        $expensesPerYear[ $year2] = 0;
        $expensesPerYear[ $year3] = 0;


        $pettyCashExpenses = DB::select("SELECT YEAR(`voucherdate`) AS expenyear, SUM(`debit`) AS total FROM `disbursment_news`
        WHERE  deleted_at IS NULL AND YEAR(voucherdate) >= (YEAR(CURDATE()) - 3) GROUP BY expenyear");
        
        foreach( $pettyCashExpenses as $expeY4){
            $expensesPerYear[$expeY4 ->expenyear ] = $expensesPerYear[$expeY4 ->expenyear ] + $expeY4->total;
        }



        $incomePY = DB::select("SELECT YEAR(`voucherdate`) AS expenyear, SUM(`credit`) AS total FROM `disbursment_news`
        WHERE  deleted_at IS NULL AND YEAR(voucherdate) >= (YEAR(CURDATE()) - 3) GROUP BY expenyear");
        
        foreach( $incomePY as $expeY4){
            $incomePerYear[$expeY4 ->expenyear ] = $incomePerYear[$expeY4 ->expenyear ] + $expeY4->total;
        }









        return view('home', compact('incomePerYear','expensesPerYear','projects','projectdetils','mytotals','projectdetils2'));
    }

    public function test()
    {
        return view('testhome');
    }

    
    
    
}
