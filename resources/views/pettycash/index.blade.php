@extends('layouts.design')
@section('content')

    <!-- Start content -->
    <div class="content">

        <!-- Top Bar Start -->
        <div class="topbar">

        </div>
        <!-- Top Bar End -->

        <div class="page-content-wrapper ">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4 class="page-title m-0"><button type="button" class="btn btn-secondary btn-md  mr-1"
                                        > <b >  <h2><b> BALANCE: {{number_format($current_balance,2)}} </b></h2>
                                        </b></button> </h4>
                                </div>
                                <div class="col-md-6">
                                    
                                  
                                
                                            <button type="button"  class="btn btn-info btn-md float-right mr-1"  target="_blank"  data-toggle="modal" data-target="#modal-pettycashreport" data-backdrop="static" data-keyboard="false" href="#"> <b class="mdi mdi-file-pdf" aria-hidden="true"> Print Report </b></button>

                                    <button type="button" class="btn btn-warning btn-md float-right mr-1"
                                        data-toggle="modal" data-target="#modal-issuefunds" data-backdrop="static"
                                        data-keyboard="false" href="#"> <b class="fa fa-minus-circle"> Issue Cash
                                        </b></button>
                                    <button type="button" class="btn btn-success btn-md float-right mr-1"
                                        data-toggle="modal" data-target="#modal-addfunds" data-backdrop="static"
                                        data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Funds
                                        </b></button>
                                </div>

                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end page-title-box -->
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">

                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th  style="width: 30%">Description</th>
                                            <th>Date</th>
                                            <th>To</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                       
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>{{ $transaction->description }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($transaction->transaction_date)) }} </td>
                                                    <td>{{ $transaction->issuedto }}</td>
                                                    <td> <?php if ($transaction->transactiontype ==
                                                        'Deposit') { ?>
                                                        <span class="badge badge-success">Deposit</span>
                                                        <?php } else { ?>
                                                        <span class="badge badge-info">Withdraw</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                                    <td>
                                                                <a class="btn btn-primary btn-sm" href="pettycash/{{$transaction->transactionid}}/edit"><i class="fas fa-edit"></i></a>
                                                                <button type="button" class="btn btn-danger btn-sm mr-1 delete-confirm"  href="pettycash/{{$transaction->transactionid}}/destroy"> <a  data-role="deletepetty"> <i class="fa fa-trash" > </i></a>  </button>  
                                                               
                                                                <a class="btn btn-warning btn-sm" href="pettycash/reprintreceipt/{{$transaction->transactionid}}/print" target="_blank"><i class="fa fa-print"></i></a>
                      
                                                                <a class="btn btn-success btn-sm" href="pettycash/pushtoproject/{{$transaction->transactionid}}/push" target="_blank"><i class="fa fa-arrow-right"></i></a>


                                                    <?php $counter += 1; ?>
                                                </tr>
                                            @endforeach
                                      
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>



            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->


@include('pettycash.pettymodals')
    <!-- End Right content here -->
@endsection
