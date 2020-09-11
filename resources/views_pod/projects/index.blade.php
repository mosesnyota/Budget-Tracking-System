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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="nobuttonstable" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr >
                    <th style="width:10px">#</th>
                    <th>Project</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th >Budget</th>
                    <th >Balance</th>
                    <th></th>
                   
                 
            
                  </tr>
                  </thead>
                  <tbody>
                    <?php $counter = 1 ; ?>
                    @foreach($projects2 as $project)
                            <tr>
                                <td style="width:10px">{{$counter}}</td>
                                <td>{{$project -> project_name}}</td>
                                <td> {{ date("d-m-Y", strtotime($project -> deadline)) }} </td>
                                
                                <td>  <?php if($project -> cur_status == 'Complete'){ ?>
                                  <span class="badge badge-success">Completed</span>
                                  <?php }
                                     else if($project -> cur_status == 'Active'){?>
                                      <span class="badge badge-info">Active</span> 
                                      <?php } ?>
                              </td>
                            <td><span class="badge badge-success">{{number_format($project->budget,2)}}</span> </td>
                            <td><span class="badge badge-info">{{number_format(($project->budget)- $mytotals[$project->project_id],2)}}</span> </td>
                            <td><a href="viewproject/{{$project ->project_id}}" title="Click to Open"><i  <button type="button" class="btn btn-secondary hvr-icon-float-away btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> OPEN </button></a></td>
	

                                <?php $counter += 1 ; ?>
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
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection


