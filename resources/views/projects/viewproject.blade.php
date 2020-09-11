
@extends('layouts.design')
@section('content')







<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fa fa-bank" aria-hidden="true"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">BUDGET</span>
                      <span class="info-box-number">
                        <h6><b> {{number_format($project ->budget,2)}} </b></h6>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-money" aria-hidden="true"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">BALANCE</span>
                        <span class="info-box-number">
                          <h6><b> {{number_format(($project ->budget - $totalAmountUsed),2)}} </b></h6>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                <div class="col-sm-6">
                    <a href="#" class="btn btn-danger btn-md float-right mr-1" role="button"><b class="fa fa-trash"> Delete </b></a>
                    <a href="/blog/public/projectreport/{{$project ->project_id}}" class="btn btn-warning btn-md float-right mr-1" role="button"><b class="fa fa-file-pdf-o"> Print Report </b></a>
                    <a href="/blog/public/editproject/{{$project ->project_id}}" class="btn btn-secondary btn-md float-right mr-1" role="button"><b class="fa fa-edit"> Edit Project </b></a>
                </div>
                
              </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
<div class="content">
  <div class="container-fluid">


    <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary card-outline">
            <div class="card-header">
              <h2 class="card-title"><b>BASIC DETAILS</b></h2>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Download PDF Report</a>
                    <a href="#" class="dropdown-item">Print Summary Report</a>
                  </div>
                </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    
                    <tbody>
                    <tr>
                      <td><h6><a>Project Name</a></td>
                      <td><h6>{{ $project->project_name }}</h6></td>
                    </tr>
                    <tr>
                      <td><h6><a>Budget</a></h6></td>
                      <td><h6>{{ $project->budget2 }}</h6></td>
                    </tr>
                    <tr>
                      <td><h6><a >Location </a></h6></td>
                      <td><h6>{{ $project->location }}</h6></td>
                    </tr>
                    <tr> 
                   
                      <td><h6><a>Start Date</a></h6></td>
                      <td><h6><span class="badge badge-warning">{{$project ->start_date}}</span></h6></td>
                    </tr>
                    <tr>
                      <td><h6><a >Deadline </a></h6></td>
                      <td><h6><span class="badge badge-warning">{{$project ->deadline}}</span></h6></td>
                    </tr>
                    <tr>
                      <td><h6><a>Funded By</a></h6></td>
                      <td><h6><span class="badge badge-success">{{$sponsor -> sponsornames}}</span></h6></td>
                    </tr>
                    <tr>
                      <td><h6><a >Assigned To</a></h6></td>
                      <td><h6><span class="badge badge-success">{{$staff ->firstname ." ". $staff ->othernames}}</span></h6></td>
                    </tr>
                    <tr> <td></td><td></td></tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 100%</span>
                    <h5 class="description-header"> {{number_format($project->budget,2)}}</h5>
                    <span class="description-text">TOTAL BUDGET</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                  <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> {{number_format(($totalAmountUsed/($project->budget) * 100),1)}}%</span>
                    <h5 class="description-header"> {{number_format($totalAmountUsed,2)}}</h5>
                    <span class="description-text">TOTAL USED</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{ number_format((($project->budget - $totalAmountUsed) / $project->budget) * 100,1 )}}%</span>
                    <h5 class="description-header"> {{number_format(($project->budget - $totalAmountUsed),2)}}</h5>
                    <span class="description-text">BALANCE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                @php  
                $days = $project->days;
                $activityday = $completionStatus[$project->project_id];
                $completeddays = ($activityday/$days) * 100;      
               @endphp
                <div class="col-sm-3 col-6">
                  <div class="description-block">
                    <span class="description-percentage text-warning"><i class="fas fa-caret-down"></i> {{number_format($completeddays,1)}}%</span>

                   
                  <h5 class="description-header"> {{number_format($completeddays,1)}} %</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>



      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary card-outline collapsed-card">
            <div class="card-header">
              <h2 class="card-title"><b>OTHER DETAILS</b></h2>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
               
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="form-group row">
                    <div class="col-sm-10">
                      <textarea class="form-control" disabled rows="3" name="details" id="details" >{{$project ->details}}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-12 col-sm-12">
          <div class="card  card-tabs">
          
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">FUNDS DISBURSEMENT</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">BUDGET LINES</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">CRITICAL MILESTONES</a>
                </li>
               
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
               
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                   
                    <div class="row"> <div class="col-12 col-sm-12">
                    
                        <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-dispersfunds" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Record Transaction </b></button>
    
                    </div></div>
                   
                    <div class="row"><div class="col-12 col-sm-12">
                        <div class="card">
                    <table id="nobuttonstable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr >
                          <th style="width:10px">#</th>
                          <th>Votehead</th>
                          <th>Date</th>
                          <th>Reference</th>
                          <th>Amount</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $counter = 1 ; ?>

                          @foreach ($disbursments as $disbursment)
                                  <tr>
                                      <td style="width:10px">{{$counter}}</td>
                                      <td>{{$disbursment ->votehead_name}}</td>
                                      <td> {{ date("d-m-Y", strtotime($disbursment ->disbursment_date)) }} </td>
                                      <td>{{$disbursment ->reference}}</td>
                                      <td>{{number_format($disbursment ->disbursment_amount,2)}}</td>
                                      
                                      <td><button type="button" class="btn btn-success btn-sm mr-1"><i class="fa fa-edit"> </i></button>
                                      <button type="button" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"> </i></button>
                                      </td>
                                    
                                      <?php $counter += 1 ; ?>
                                  </tr>
                           @endforeach

                        </tbody>
                      </table>
                </div>
            </div>
        </div></div>


            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                
                <div class="row"> <div class="col-12 col-sm-12">
                    
                    <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addvotehead" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Vote Head </b></button>

                </div></div>
                
                <div class="row"><div class="col-12 col-sm-12">
                <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body p-0">
                    <!-- .table-responsive -->
            
                    <div class="table-responsive">
                        <table class="table m-0">
                          <thead>
                          <tr>
                            <th>ID</th>
                            <th>Vote Head</th>
                            <th>Amount</th>
                            <th>Used</th>
                            <th>Balance</th>
                            <th></th>
                            
                          </tr>
                          </thead>
                          <tbody>
                            <?php $counter = 1 ; ?>
                        @foreach ($voteheads as $votehead)
                        @php $voteheadid =  $votehead->votehead_id   @endphp
                        <tr>
                            <td><a>VTH0{{$counter}}</a></td>
                            <td>{{$votehead ->votehead_name}}</td>
                            <td>{{number_format($votehead ->amount_allocated,2)}}</td>

                         @if ( array_key_exists($voteheadid,$mytotals))
                         <td><span class="badge badge-success">{{number_format($mytotals[$voteheadid],2)}}</span></td>
                         <td><span class="badge badge-warning">{{number_format(($votehead ->amount_allocated - $mytotals[$voteheadid]),2)}}</span></td>
                                                   
                        @else
                        <td><span class="badge badge-success">{{number_format(0,2)}}</span></td>
                        <td><span class="badge badge-warning">{{number_format(($votehead ->amount_allocated - 0),2)}}</span></td>
                           
                            
                        
                         @endif   
                         
                        
                        <td><button type="button" class="btn btn-success btn-sm mr-1"><i class="fa fa-edit"> </i></button>
                            <button type="button" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"> </i></button>
                            <button type="button" class="btn btn-warning btn-sm mr-1"><i class="fa fa-file-pdf-o"> Statement </i></button></td>
                        </tr>
                        <?php $counter += 1 ; ?>
                        @endforeach
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
            </div>
            </div>
                

            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                
              <div class="row"> <div class="col-12 col-sm-12">
                    
                <button type="button"  class="btn btn-success btn-md float-right mr-1"  data-toggle="modal" data-target="#modal-addactivity" data-backdrop="static" data-keyboard="false" href="#"> <b class="fa fa-plus-circle"> Add Milestone</b></button>

            </div></div>

                <div class="row"><div class="col-12 col-sm-12">
                <div class="card">
                    <!-- /.card-header -->
                 <div class="card-body p-0">
                    <!-- .table-responsive -->
            
                    <div class="table-responsive">
                        <table class="table m-0">
                          <thead>
                          <tr>
                            <th>ID</th>
                            <th>Activity</th>
                            <th>Start Date</th>
                            <th>Deadline</th>
                            <th>Status</th>
                           
                            
                          </tr>
                          </thead>
                          <tbody>
                            <?php $counter = 1 ; ?>
                        @foreach ($activities as $activity)
                       
                        <tr id="{{$activity ->activity_id}}">
                            <td data-target="counter"><a>ACT0{{$counter}}</a></td>
                            <td data-target="activityname">{{$activity->activityname}}</td>
                            <td data-target="startdate">{{$activity ->start_date}}</td>
                            <td data-target="deadline">{{$activity ->deadline_date}}</td>
                            
                            @if($activity ->cur_status == "Completed") 
                              <td data-target="curstatus"><span class="badge badge-success">{{$activity ->cur_status}}</span></td>
                            @elseif($activity ->cur_status == "ongoing")
                              <td data-target="curstatus"><span class="badge badge-warning">{{"In Progress"}}</span></td>
                            @elseif($activity ->cur_status == "onhold")
                              <td data-target="curstatus"><span class="badge badge-danger">{{"On Hold"}}</span></td>
                            @endif 
       
                          <td><button type="button" class="btn btn-success btn-sm mr-1"> <a  data-role="update"  data-id="{{$activity ->activity_id}}"> <i class="fa fa-eye" > Update </i></a>  </button>
                          <button type="button" class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"> </i></button>
                          <button type="button" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"> </i></button></td>
                            
                           


                        </tr>
                        <?php $counter += 1 ; ?>
                        @endforeach
                          
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
            </div>
            



            </div>  

                
              </div>
            </div>
           
          </div> <!-- /.card -->
        </div>
       
      </div>
   </div>
 </div>
</div>
@endsection

@include('projects.modals')






