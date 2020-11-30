<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funding;
use App\Sponsor;
use App\Project;


use DB;
use App\MyPDF;

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
       
        $sponsors = Sponsor::all();
        $activeprojects = Project::where('cur_status','=','Active')->get();

      
        $fundings = DB::table('fundings')
        ->leftJoin('projects', 'fundings.project_id', '=', 'projects.project_id')
        ->select('fundings.*', 'project_name')
        ->where('fundings.deleted_at', '=', NULL)
        ->orderBy('fundings.funding_date', 'DESC')
        ->get();


        $funds = array();
        $curyearfunds =  DB::table('fundings')
        ->select(DB::raw('sum(final_amount) as total'))
        ->whereRAW('YEAR(funding_date) =?', [ date("Y")])
        ->where('fundings.deleted_at', '=', NULL)
        ->get();

        foreach ($curyearfunds as $totald){ 
            $funds['thisyear'] =  $totald->total;
        }

        $curmonth =  DB::table('fundings')
        ->select(DB::raw('sum(final_amount) as total'))
        ->whereRAW('month(funding_date) = ?', [ date("m")])
        ->where('fundings.deleted_at', '=', NULL)
        ->get();

        foreach ($curmonth as $totalds){ 
            $funds['thismonth'] =  $totalds->total;
        }
        return view('funds.index',compact('fundings','sponsors','funds','activeprojects'));
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

    public function report1(Request $request){
        $input = $request->all();
        $startdate =   date('Y-m-d',strtotime( $input['start']));
        $enddate =   date('Y-m-d',strtotime( $input['end']));
        $input['start'] = $startdate;
        $input['end'] = $enddate;
        return view('funds.openreport',compact('input'));

    } 

    public function report($start,$end){

        
        $startdate =   date('Y-m-d',strtotime( $start));
        $enddate   =   date('Y-m-d',strtotime( $end));
       
       
        
        $fundings =  DB::table('fundings')
        ->leftJoin('sponsors', 'sponsors.sponsor_id', '=', 'fundings.sponsor_id')
        ->leftJoin('projects', 'projects.project_id', '=', 'fundings.project_id')
        ->select(DB::raw('fundings.*, sponsornames,project_name'))
        ->where('fundings.funding_date', '>=', $startdate)
        ->where('fundings.funding_date', '<=', $enddate)
        ->where('fundings.deleted_at', '=', NULL)
        ->get();

        $pdf = new MyPDF();
       $pdf-> SetWidths(7);
        $pdf->AddPage('L');
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->Ln(7);
        $pdf-> Cell(280, 10, "Funds Received between ". date('d-m-Y',strtotime($start)) . "  ".date('d-m-Y',strtotime( $end)),0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);

                //table header
        $pdf->SetFillColor(157, 245, 183);
        $pdf->setFont("times", "", "11");

    
        $pdf->Cell(105, 7, "RECEIVED FUNDS", 1, 0, "C", 1);
        $pdf->SetFillColor(224, 235, 255);
        $pdf->Ln();
        $pdf->Cell(20, 7, "#", 1, 0, "L", 1);
        $pdf->Cell(30, 7, "Date", 1, 0, "C", 1);
        $pdf->Cell(63, 7, "Project", 1, 0, "C", 1);
        $pdf->Cell(54, 7, "Financier", 1, 0, "C", 1);
        $pdf->Cell(20, 7, "Currency", 1, 0, "C", 1);
        $pdf->Cell(30, 7, "Amount", 1, 0, "C", 1);
        $pdf->Cell(20, 7, "Rate", 1, 0, "C", 1);
        $pdf->Cell(40, 7, "Amount [Local Cur]", 1, 0, "C", 1);
        $pdf->Ln();
     
        $counter = 1;
        $pdf->SetWidths(array(20,30,63,54,20,30,20,40));
        $aligns = array('L','C','L','L','C','R','R','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(224, 235, 255);
        $current_balance = 0;
      
        $fill = 1 ;
        foreach ($fundings as $funding){ 
            $fill =  !$fill;
            $pdf->Row(array( "TRX0".$counter,date('d-m-Y',
            strtotime($funding ->funding_date)),
            $funding ->project_name,
            $funding ->sponsornames,
            $funding ->currency,
            number_format($funding->original_amount,2),
            number_format($funding->exchangerate,2),
            number_format($funding ->final_amount,2)), $fill);
            $counter++;
            $current_balance += $funding ->final_amount;
            
        }
   
        $pdf-> Cell(237, 10, "Total Received",1, 0, 'C', 1, '');
        $pdf-> Cell(40, 10,  number_format($current_balance,2),1, 0, 'R', 1, '');
        $pdf->Output("Received Funds Report.pdf", "I");
        exit;
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

        try {
            $funding->save();
            alert()->success('Success', 'Created Successfully');
          
            return redirect()->action(
                'FundingController@index'
            );
    
        } catch (\Exception $ex) {
                alert()->error('Failed! An error occured! Try Again!.', '');
                return back()->with('error', '  An Error Occured.');
        }
        
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
