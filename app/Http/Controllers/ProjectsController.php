<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\Sponsor;
use App\Project;
use App\Activities;
use App\Votehead;
use App\DisbursmentNew;
use PDF;
use DB;
use App\MyPDF;
use SweetAlert;

class ProjectsController extends Controller
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
        //get details of all projects
        $projects =  Project::all();
        $projects2 =  DB::table('projects')
        ->select(DB::raw('project_id,project_name,location,start_date,deadline,sponsor_id,staff_id,budget,cur_status,details,created_at,updated_at,DATEDIFF(deadline, start_date) AS days'))
        ->get();

        $completedactivities = DB::table('activities')
            ->join('projects', 'projects.project_id', '=', 'activities.project_id')
            ->select(DB::raw(' projects.project_id, SUM(DATEDIFF(activities.deadline_date , activities.start_date) ) AS activitydays '))
            ->where('activities.cur_status', '=', 'Completed')
            ->groupBy('projects.project_id')
            ->get();

            $completionStatus = array();
            foreach ($projects as $project){ 
                $val = $project->project_id;
                $completionStatus[$val] =  0;
            }

            foreach ($completedactivities as $activity1){ 
                $val = $activity1->project_id;
                $completionStatus[$val] =  $activity1->activitydays;
            }
            
        //this section checks the number of all active projects
        $countprojects =  DB::table('projects')
            ->select(DB::raw('COUNT(*) AS total'))
            ->where('cur_status', '=', 'Active')
            ->get();
    
            $ongoingprojects = 0 ;
            foreach ($countprojects as $totald){ 
                $ongoingprojects = $totald->total;
            }
        $projects->projectcnt = $ongoingprojects;


        //This section gets the number of completed projects

        $completed =  DB::table('projects')
            ->select(DB::raw('COUNT(*) AS total'))
            ->where('cur_status', '=', 'Complete')
            ->get();
    
            $completedprojects = 0 ;
            foreach ($completed as $totald){ 
                $completedprojects = $totald->total;
            }
        $projects->completedprojects = $completedprojects;



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

        return view('projects.index', compact('projects','mytotals','projects2','completionStatus'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs =  Staff::all() ;
        $sponsors =  Sponsor::all() ;
        return view('projects.newp', compact('staffs','sponsors'));
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
        $date = strtotime($input['start_date']); 
        $input['start_date']  =  date('Y-m-d', $date);
        $input['deadline']  =  date('Y-m-d', strtotime($input['deadline']));
        Project::create($input);
        
        alert()->success('Success', 'Projects Successfully Saved');
        
        return redirect()->action(
            'ProjectsController@index'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project =  Project::find($id) ;
        $projects =  DB::table('projects')
        ->select(DB::raw('project_id,project_name,location,start_date,deadline,sponsor_id,staff_id,budget,cur_status,details,created_at,updated_at,DATEDIFF(deadline, start_date) AS days'))
        ->where('project_id', '=', $id)
        ->get();

        foreach ($projects as $prj){ 
            $val = $prj->days;
            $project->days =  $val;
        }

        $time = strtotime($project ->start_date);
        $project ->start_date = date('d-m-Y',$time);

        $time2 = strtotime($project ->deadline);
        $project ->deadline = date('d-m-Y',$time2);
        $project ->budget2 = number_format($project ->budget,2);
        $voteheads = Votehead::all()->where('project_id', '=', $id) ;
        $activities = Activities::all()->where('project_id', '=', $id) ;

        $completedactivities = DB::table('activities')
        ->select(DB::raw('project_id, SUM(DATEDIFF(activities.deadline_date , activities.start_date) ) AS activitydays '))
        ->where('cur_status', '=', 'Completed')
        ->where('project_id', '=', $id)
        ->groupBy('project_id')
        ->get();

        $completionStatus = array();
        
        $completionStatus[$id] =  0;
       

        foreach ($completedactivities as $activity1){ 
            $val = $activity1->project_id;
            $completionStatus[$val] =  $activity1->activitydays;
        }

        

        $voteheadtotals =  DB::table('disbursment_news')
        ->select(DB::raw('votehead_id, SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->groupBy('votehead_id')
        ->get();

        $mytotals = array();
        foreach ($voteheadtotals as $totald){ 
            $val = $totald->votehead_id;
            $mytotals[$val] =  $totald->total;
        }

        $sponsor = Sponsor::find($project ->sponsor_id) ;
        $staff =  Staff::find($project ->staff_id) ;
        //get total budget expenditure for this project
        $totalused =  DB::table('disbursment_news')
        ->select(DB::raw('SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->get();

        $totalAmountUsed = 0;
      
        foreach ($totalused as $totald){ 
            $totalAmountUsed = $totald->total;
        }

        $disbursments = DB::table('disbursment_news')
            ->leftJoin('voteheads', 'disbursment_news.votehead_id', '=', 'voteheads.votehead_id')
            ->select('disbursment_news.*', 'voteheads.votehead_name')
            ->where('disbursment_news.project_id', '=', $id)
            ->orderBy('disbursment_news.created_at', 'DESC')
            ->get();




        return view('projects.viewproject2', compact('disbursments','completionStatus','activities','project','staff','sponsor','voteheads','mytotals','totalAmountUsed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staffs =  Staff::all() ;
        $sponsors =  Sponsor::all() ;
        $project =  Project::find($id) ;
        return view('projects.editproject', compact('project','staffs','sponsors'));
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
        $date = strtotime($input['start_date']); 
        $input['start_date']  =  date('Y-m-d', $date);
        $input['deadline']  =  date('Y-m-d', strtotime($input['deadline']));
        $project = Project::find($id);
        $project ->project_name = $input['project_name'];
        $project ->location = $input['location'];
        $project ->start_date = $input['start_date'];
        $project ->deadline = $input['deadline'];
        $project ->sponsor_id = $input['sponsor_id'];
        $project ->staff_id = $input['staff_id'];
        $project ->budget = $input['budget'];
        $project ->details = $input['details'];
        $project->save();
        
        alert()->success('Success', 'Projects Successfully Saved');
        
        return redirect()->action(
            'ProjectsController@show',$project->project_id
        );
       
    }


    


    
    public function printPdfReport($id){
        $project =  Project::find($id) ;
        $time = strtotime($project ->start_date);
        $project ->start_date = date('d-m-Y',$time);

        $time2 = strtotime($project ->deadline);
        $project ->deadline = date('d-m-Y',$time2);
        $project ->budget2 = number_format($project ->budget,2);

        $voteheads = Votehead::all()->where('project_id', '=', $id) ;
        $activities = Activities::all()->where('project_id', '=', $id) ;

        $disbursments= DB::table('disbursment_news')
            ->join('voteheads', 'disbursment_news.votehead_id', '=', 'voteheads.votehead_id')
            ->select('disbursment_news.*', 'voteheads.votehead_name')
            ->where('disbursment_news.project_id', '=', $id)
            ->orderBy('disbursment_news.voucherdate', 'DESC')
            ->get();

        $voteheadtotals =  DB::table('disbursment_news')
        ->select(DB::raw('votehead_id, SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->groupBy('votehead_id')
        ->get();

        $mytotals = array();
        foreach ($voteheadtotals as $totald){ 
            $val = $totald->votehead_id;
            $mytotals[$val] =  $totald->total;
        }


        $sponsor = Sponsor::find($project ->sponsor_id) ;
        $staff =  Staff::find($project ->staff_id) ;


        //get total budget expenditure for this project
        $totalused =  DB::table('disbursment_news')
        ->select(DB::raw('SUM(debit) AS total'))
        ->where('disbursment_news.project_id', '=', $id)
        ->get();

        $totalAmountUsed = 0;
      
        foreach ($totalused as $totald){ 
            $totalAmountUsed = $totald->total;
            
        }

  
       $pdf = new MyPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->Ln(7);
        $pdf-> Cell(195, 10, "Project Report",0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);

     
        //table header
$pdf->SetFillColor(157, 245, 183);
$pdf->setFont("times", "", "11");
$pdf->setXY(10, 60);
$pdf->Cell(105, 7, "PROJECT DETAILS", 1, 0, "L", 1);
$pdf->Ln();
$pdf->Cell(40, 7, "Project Name :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->project_name, 1, 0, "L", 0);




$pdf->Ln();
$pdf->Cell(40, 7, "Description :", 1, 0, "L", 0);
$pdf->Cell(90, 7, strip_tags($project->details), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Location :", 1, 0, "L", 0);
$pdf->Cell(90, 7, strip_tags($project->location,'<p>'), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Start Date :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->start_date, 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Deadline :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->deadline, 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Completed On :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $project->completed_on, 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Total Budget :", 1, 0, "L", 0);
$pdf->Cell(90, 7, number_format($project->budget, 2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Disbursed Amount :", 1, 0, "L", 0);
$pdf->Cell(90, 7,  number_format( $totalAmountUsed, 2), 1, 0, "L", 0);
$pdf->Ln();
$pdf->Cell(40, 7, "Balance :", 1, 0, "L", 0);
$pdf->Cell(90, 7,  number_format($project->budget -  $totalAmountUsed, 2), 1, 0, "L", 0);
$pdf->Ln();

$pdf->Cell(40, 7, "Funded By :", 1, 0, "L", 0);
$pdf->Cell(90, 7,  $sponsor->sponsornames, 1, 0, "L", 0);
$pdf->Ln();

$pdf->Cell(40, 7, "Assigned To :", 1, 0, "L", 0);
$pdf->Cell(90, 7, $staff->firstname." ".$staff->othernames  , 1, 0, "L", 0);
$pdf->Ln();



$pdf->Ln();
$pdf->Cell(105, 7, "BUDGET VOTEHEADS", 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(55, 7, "Vote Head", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Total Allocation", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Paid Out", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Balance", 1, 0, "C", 1);
$pdf->Ln();
$counter = 1; 
$y = $pdf->GetY();
$x = 10;
$fill = 0;
foreach ($voteheads as $votehead){ 
    $voteheadid =  $votehead->votehead_id;
    $pdf->Cell(20, 7,"VTH0".$counter, 1, 0, "L", $fill);
    $pdf->Cell(55, 7, $votehead ->votehead_name, 1, 0, "L", $fill);
    $pdf->Cell(40, 7, number_format($votehead ->amount_allocated,2), 1, 0, "R", $fill);

    if(array_key_exists($voteheadid,$mytotals)){
        $pdf->Cell(40, 7, number_format($mytotals[$voteheadid],2), 1, 0, "R", $fill);
        $pdf->Cell(40, 7, number_format(($votehead ->amount_allocated - $mytotals[$voteheadid]),2), 1, 0, "R", $fill);
    }else{
        $pdf->Cell(40, 7, number_format(0,2), 1, 0, "R", $fill);
        $pdf->Cell(40, 7, number_format(($votehead ->amount_allocated - 0),2), 1, 0, "R", $fill);
    }
    
    $counter++;
    
    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 40);

        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(40, 7, "Vote Head", 1, 0, "C", 1);
        $pdf->Cell(35, 7, "Total Allocation", 1, 0, "C", 1);
        $pdf->Cell(30, 7, "Paid Out", 1, 0, "C", 1);
        $pdf->Cell(30, 7, "Balance", 1, 0, "C", 1);

        $pdf->Ln();
        $y = 47;
    }

    $pdf->Ln();
    $pdf->SetFillColor(224, 235, 255);
    $pdf->setXY($x, $y);
}

$y = $pdf->GetY();
$pdf->setXY($x, $y);
$pdf->Ln();
$pdf->SetFillColor(157, 245, 183);
$pdf->Cell(105, 7, "FINANCE DISBURSMENT REPORT", 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(55, 7, "Vote Head", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Date", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Reference", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Amount", 1, 0, "C", 1);

$pdf->Ln();
$counter = 1;
foreach ($disbursments as $disbursment){ 
    
    $pdf->Cell(20, 7,"TRX0".$counter, 1, 0, "L", $fill);
    $pdf->Cell(55, 7, $disbursment ->votehead_name, 1, 0, "L", $fill);
    $pdf->Cell(40, 7, date("d-m-Y", strtotime($disbursment ->voucherdate)), 1, 0, "R", $fill);
    $pdf->Cell(40, 7, $disbursment ->chequeno, 1, 0, "R", $fill);
    $pdf->Cell(40, 7, number_format($disbursment ->debit,2), 1, 0, "R", $fill);
    $counter++;
    
    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 40);

        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(55, 7, "Vote Head", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Date", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Reference", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Amount", 1, 0, "C", 1);
        $pdf->Ln();
        $y = 47;
    }

    $pdf->Ln();
    $pdf->SetFillColor(224, 235, 255);
   
}




$y = $pdf->GetY();
$pdf->setXY($x, $y);
$pdf->Ln();
$pdf->SetFillColor(157, 245, 183);
$pdf->Cell(105, 7, "CRITICAL MILESTONES", 1, 0, "C", 1);
$pdf->SetFillColor(224, 235, 255);
$pdf->Ln();
$pdf->Cell(20, 7, "#", 1, 0, "L", 1);
$pdf->Cell(75, 7, "Activity Name", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Start Date", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Deadline", 1, 0, "C", 1);
$pdf->Cell(40, 7, "Current Status", 1, 0, "C", 1);

$pdf->Ln();
$counter = 1;
foreach ($activities as $activity){ 
    $pdf->Cell(20, 7,"ACT0".$counter, 1, 0, "L", $fill);
    $pdf->Cell(75, 7, $activity->activityname, 1, 0, "L", $fill);
    $pdf->Cell(30, 7, date("d-m-Y", strtotime($activity ->start_date)), 1, 0, "R", $fill);
    $pdf->Cell(30, 7, date("d-m-Y", strtotime($activity ->deadline_date)), 1, 0, "R", $fill);

    if($activity ->cur_status == "Completed"){
        $pdf->SetFillColor(157, 245, 183);
        $pdf->Cell(40, 7, $activity ->cur_status, 1, 0, "L", 1);
    }
    
    if($activity ->cur_status == "ongoing"){
        $pdf->SetFillColor(247, 219, 134);
        $pdf->Cell(40, 7, "Ongoing", 1, 0, "L", 1);
    }
    
    $counter++;
    
    $y += 7;
    $fill = !$fill;
    if ($y > 275) {
        $pdf->AddPage();
        $pdf->SetFillColor(128, 128, 128); //gray
        $pdf->setFont("times", "", "11");
        $pdf->setXY(10, 40);

        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(55, 7, "Activity Name", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Start Date", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Deadline", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Current Status", 1, 0, "C", 1);
        $pdf->Ln();
        $y = 47;
    }

    $pdf->Ln();
    $pdf->SetFillColor(224, 235, 255);
   
}


        $pdf->Output();
        exit;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DisbursmentNew::where('project_id',$id)->delete();
        Votehead::where('project_id',$id)->delete();
        Activities::where('project_id',$id)->delete();
        Project::where('project_id',$id)->delete();

        return redirect()->action(
            'ProjectsController@index'
        );
    }
}
