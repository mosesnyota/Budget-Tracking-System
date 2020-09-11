@extends('layouts.design')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Ongoing Projects</span>
                  <span class="info-box-number">
                    {{$projects->projectcnt}}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
  
                <div class="info-box-content">
                <span class="info-box-text">Completed</span>
                  <span class="info-box-number">{{$projects->completedprojects}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

           
          <div class="col-sm-6">
            <a href="newproject" class="btn btn-warning btn-md float-right mr-1" role="button"><b class="fa fa-file-pdf-o"> Statements </b></a>
            <a href="newproject" class="btn btn-success btn-md float-right mr-1" role="button"><b class="fa fa-plus-circle"> New Project </b></a>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Projects</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <table id="stafftable" class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 20%">Project</th>
                        <th>Budget</th>
                        <th>Progress</th>
                        <th style="width: 8%" class="text-center">Status</th>
                        <th style="width: 20%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1 ; ?>
                    @foreach($projects2 as $project)
                <?php 
                    $now = time(); 
                    $deadlinedate = strtotime($project ->deadline);
                    $datediff = $deadlinedate - $now ;
                    $time2 = strtotime($project ->deadline);  
                    $pdeadline= date('d-m-Y',$time2);
                    $days = round($datediff / (60 * 60 * 24));
                    $startdate = date('d-m-Y',strtotime($project ->start_date) );
                    $percentused =  ($mytotals[$project->project_id]/($project->budget) * 100) ;

                    $percentusedlabel = "bg-warning";
                    if($percentused < 25){
                      $percentusedlabel = "bg-danger";
                    }else if($percentused < 25){
                      $percentusedlabel = "bg-warning";
                    }else if($percentused < 25){
                      $percentusedlabel = "bg-success";
                    }
              ?>


                    <tr>
                        <td style="width:10px">{{$counter}}</td>
                        <td>
                            <a>
                                {{$project->project_name}}
                            </a>
                            <br/>
                        </td>
                        
                        <td class="project_progress">
                            <div class="progress progress-sm">
                            <div class="progress-bar progress-bar-striped {{$percentusedlabel}}" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: {{$percentused}}%">
                                </div>
                            </div>
                            <small>
                              <?php if($percentused < 25){ ?>
                                <span class="badge badge-danger">{{number_format($percentused,1).' % Used '}}</span>
                                <?php }
                                   else if($days > 25 && $days < 75){?>
                                    <span class="badge badge-warning">{{number_format($percentused,1).' % Used '}}</span> 
                                    <?php }  else if($days > 75){?>
                                      <span class="badge badge-success">{{number_format($percentused,1).' % Used '}}</span> 
                                      <?php } ?>
                            </small>
                        </td>

                        @php
                          $days = $project->days;
                          $activityday = $completionStatus[$project->project_id];
                          $completeddays = ($activityday/$days) * 100;      
                        @endphp
                        <td class="project_progress">
                            <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: {{$completeddays}}%">
                                </div>
                            </div>
                            <small>
                              
                                {{number_format($completeddays,1)}} %
                            </small>
                        </td>
                        

                        <td class="project-state">
                            <span class="badge badge-success">Success</span>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="viewproject/{{$project ->project_id}}">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-danger btn-sm" href="viewproject/{{$project ->project_id}}">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>
                        <?php $counter += 1 ; ?>
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  
      </section>
    <!-- /.content -->
  </div>

@endsection


