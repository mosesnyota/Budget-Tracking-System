@extends('layouts.design')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$projects['activeprojects']}}</h3>

              <p>Ongoing Projects</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="projects/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$projects['completedprojects']}}<sup style="font-size: 20px"></sup></h3>

              <p>Complete Projects</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="projects/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{number_format($projects['totalbudget'],0)}}</h3>

              <p>Active Budget</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{number_format($projects['totalbudget'] - $projects['totalused'],0) }}</h3>

              <p>Unused Budget</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Sales</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">$18,230.00</span>
                  <span>Sales Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 33.1%
                  </span>
                  <span class="text-muted">Since last month</span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This year
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last year
                </span>
              </div>
            </div>
          </div>

        </section>
          <section class="col-lg-6 connectedSortable">
          <!-- /.card -->
         <!-- TABLE: LATEST ORDERS -->
         <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Projects</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                <tr>
                  <th>Project Name</th>
                  <th>Status</th>
                  <th>Completed</th>
                  <th>Budget</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach ($projectdetils as $details)

                <?php $percentused =  ($mytotals[$details->project_id]/($details->budget) * 100) ?>
                <tr>
                  <td><a href="/blog/public/viewproject/{{$details->project_id}}">{{$details->project_name}}</a></td>
                  

                  <td>  <?php if($details->cur_status == 'Complete'){ ?>
                    <span class="badge badge-success">Completed</span>
                    <?php }
                       else if($details->cur_status == 'Active'){?>
                        <span class="badge badge-warning">Active</span> 
                        <?php } ?>
                </td>


                <td>  <?php if($percentused < 25){ ?>
                  <span class="badge badge-danger">{{number_format($percentused,1).' %'}}</span>
                  <?php }
                     else if($percentused > 25 && $percentused < 75){?>
                      <span class="badge badge-warning">{{number_format($percentused,1).' %'}}</span> 
                      <?php } else if($percentused > 75){?>
                        <span class="badge badge-success">{{number_format($percentused,1).' %'}}</span> 
                        <?php } ?>
              </td>
                  

                  <td>  <?php if($percentused < 25){ ?>
                    <span class="badge badge-warning">{{number_format($percentused,1).' %'}}</span>
                    <?php }
                       else if($percentused > 25){?>
                        <span class="badge badge-success">{{number_format($percentused,1).' %'}}</span> 
                        <?php } ?>
                   </td>

                </tr>
                @endforeach
               
               
                
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <a href="/blog/public/newproject" class="btn btn-sm btn-info float-left">Add New Project</a>
            <a href="/blog/public/projects" class="btn btn-sm btn-secondary float-right">View All Projects</a>
          </div>
          <!-- /.card-footer -->
        </div>
    </section>

    <section class="col-lg-6 connectedSortable">
      <!-- /.card -->
     <!-- TABLE: LATEST ORDERS -->
     <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Projects Approaching Deadline</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
            <tr>
              <th>Project Name</th>
              <th>Deadline </th>
              <th>Days</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach ($projectdetils2 as $details)

            <?php $percentused =  ($mytotals[$details->project_id]/($details->budget) * 100) ?>
            <tr>
              <td><a href="/blog/public/viewproject/{{$details->project_id}}">{{$details->project_name}}</a></td>
              
              <?php 
            
              $now = time(); 
              $deadlinedate = strtotime($details ->deadline);
              $datediff = $deadlinedate - $now ;
              
              $time2 = strtotime($details ->deadline);  
              $pdeadline= date('d-m-Y',$time2);
              $days = round($datediff / (60 * 60 * 24));
              ?>
              
             

              <td>  <?php if($days < 0){ ?>
                <span class="badge badge-danger">{{$pdeadline}}</span>
                <?php }
                   else if($days > 0 && $days < 30){?>
                    <span class="badge badge-warning">{{$pdeadline}}</span> 
                    <?php }  else if($days > 30){?>
                      <span class="badge badge-success">{{$pdeadline}}</span> 
                      <?php } ?>
               </td>

              <td>  <?php if($days < 0){ ?>
                <span class="badge badge-danger">{{$days." Days Overdue"}}</span>
                <?php }
                   else if($days > 0 && $days < 30){?>
                    <span class="badge badge-warning">{{$days." Days"}}</span> 
                    <?php }  else if($days > 30){?>
                      <span class="badge badge-success">{{$days." Days"}}</span> 
                      <?php } ?>
               </td>
              
              
            

            </tr>
            @endforeach
           
           
            
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        
        <a href="/blog/public/projects" class="btn btn-sm btn-secondary float-right">View All</a>
      </div>
      <!-- /.card-footer -->
    </div>
</section>
        
        
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection


<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script> 
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>  

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>

