<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PettyCash;
use App\Petty;
use DB;
use App\MyPDF;


class PettyCashs extends Controller
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
        $transactions =  PettyCash::all() ;
        $balance = Petty::all();
        //This section gets the petty cash balance
        $current_balance = 0;
        foreach ($balance as $bal){ 
            $current_balance = $bal->balance;
        }
        return view('pettycash.index', compact('transactions','current_balance'));
        
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
        $date = strtotime($input['transaction_date']); 
        $input['transaction_date']  =  date('Y-m-d', $date);
        $amount = $input['amount'];

        if($input['transactiontype'] == 'Deposit'){
            DB::statement("UPDATE petties SET balance = balance +  $amount");
        }else{
            DB::statement("UPDATE petties SET balance = balance -  $amount");
        }
    
        $balance = Petty::all();
        //This section gets the petty cash balance
        $current_balance = 0;
        foreach ($balance as $bal){ 
            $current_balance = $bal->balance;
        }
        $input['balance'] =  $current_balance;
        PettyCash::create($input);
        if(session('success_message')) {
                Alert::success('Success', 'Transaction Successfully Saved');
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
        $transaction =  PettyCash::find($id) ;

        
        
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

        $transaction =  PettyCash::find($id) ;

        if($transaction -> transactiontype == 'Deposit'){
            DB::statement("UPDATE petties SET balance = balance -   $transaction->amount ");
        }else{
            DB::statement("UPDATE petties SET balance = balance +  $transaction->amount ");
        }
        PettyCash::where('transactionid',$id)->delete();
        
        return redirect()->action(
            'PettyCashs@index'
        );
    }


    public function printReport(){
        $transactions =  PettyCash::all() ;
        $balance = Petty::all();
        //This section gets the petty cash balance
        $current_balance = 0;
        foreach ($balance as $bal){ 
            $current_balance = $bal->balance;
        }
  
       $pdf = new MyPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',14);
        //Table with 20 rows and 4 columns
        $pdf->SetX(5);
        $pdf->SetFillColor(237, 228, 226);
        $pdf->Ln(7);
        $pdf-> Cell(195, 10, "Petty Cash Transactions",0, 0, 'C', 1, '');
        $pdf->Ln(15);
        $pdf->SetX(10);
        $pdf->SetFont('Times','',12);
        $pdf-> Cell(10, 10, "#",1, 0, 'C', 1, '');
        $pdf-> Cell(65, 10, "Description",1, 0, 'C', 1, '');
        $pdf-> Cell(35, 10, "Date",1, 0, 'C', 1, '');
        $pdf-> Cell(45, 10, "To",1, 0, 'C', 1, '');
        $pdf-> Cell(10, 10, "Txt",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10, "Amount",1, 0, 'C', 1, '');
        $pdf->Ln();

        $counter = 1;
        $pdf->SetWidths(array(10,65,35,45,10,30));
        $aligns = array('L','L','C','L','C','R');
        $pdf->SetAligns($aligns );
        $pdf->SetFillColor(245, 241, 216 );
        
      

        foreach($transactions as $transaction){
            $pdf->Row(array( $counter,$transaction->description, date_format(date_create($transaction ->transaction_date),"d-M-Y") ,
            $transaction -> issuedto, substr($transaction ->transactiontype, 0, 1) , number_format($transaction -> amount,2)));
            $counter++;
            
        }
   
        $pdf-> Cell(165, 10, "Current Balance",1, 0, 'C', 1, '');
        $pdf-> Cell(30, 10,  number_format($current_balance,2),1, 0, 'R', 1, '');
        $pdf->Output();
        exit;
    }


}
