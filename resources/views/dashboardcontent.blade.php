
        <div class="page-content-wrapper ">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0">Dashboard</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings mr-1"></i> Settings
                                            </button>
                                           
                                            <div class="dropdown-menu dropdown-menu-animated">
                                                <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i> Profile</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted"></i>Change Password</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="dripicons-exit text-muted"></i> Logout</a>
                                            </div>
                                        </div>
                                    </div>
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
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary mini-stat text-white">
                            <div class="p-3 mini-stat-desc">
                                <div class="clearfix">
                                    <h6 class="text-uppercase mt-0 float-left text-white-50">ACTIVE</h6>
                                    <h4 class="mb-3 mt-0 float-right">{{$projects['activeprojects']}}</h4>
                                </div>
                                <div>
                                    <span class="badge badge-light text-info"> +0% </span> <span class="ml-2">From previous year</span>
                                </div>
                                
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-cube-outline h5"></i></a>
                                </div>
                                <p class="font-14 m-0">Active Projects : {{$projects['activeprojects']}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-info mini-stat text-white">
                            <div class="p-3 mini-stat-desc">
                                <div class="clearfix">
                                    <h6 class="text-uppercase mt-0 float-left text-white-50">Completed</h6>
                                    <h4 class="mb-3 mt-0 float-right">{{$projects['completedprojects']}}</h4>
                                </div>
                                <div>
                                    <span class="badge badge-light text-danger"> +0% </span> <span class="ml-2">From previous year</span>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-buffer h5"></i></a>
                                </div>
                                <p class="font-14 m-0">Completed Projects : {{$projects['completedprojects']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-pink mini-stat text-white">
                            <div class="p-3 mini-stat-desc">
                                <div class="clearfix">
                                    <h6 class="text-uppercase mt-0 float-left text-white-50">Budget</h6>
                                    <h4 class="mb-3 mt-0 float-right">{{number_format($projects['totalbudget'],0)}}</h4>
                                </div>
                                <div>
                                    @php
                                        $prctnt = 0;
                                        if($projects['totalbudget'] != 0 ){
                                            $prctnt = number_format((($projects['totalused']/$projects['totalbudget']) * 100 ),1);
                                        }
                                    @endphp
                                <span class="badge badge-light text-primary"> {{$prctnt}} % </span> <span class="ml-2">Already Dispersed</span>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-tag-text-outline h5"></i></a>
                                </div>
                                <p class="font-14 m-0">Budget : {{number_format($projects['totalbudget'],0)}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success mini-stat text-white">
                            <div class="p-3 mini-stat-desc">
                                <div class="clearfix">
                                    <h6 class="text-uppercase mt-0 float-left text-white-50">Unused</h6>
                                    <h4 class="mb-3 mt-0 float-right">{{number_format($projects['totalbudget'] - $projects['totalused'],0) }}</h4>
                                </div>
                                <div>
                                    @php
                                        $percentused = 0;
                                        if($projects['totalbudget'] != 0 ){
                                            $percentused = 0;
                                            $percentused = (($projects['totalused']/$projects['totalbudget']) * 100 );

                                        }
                                    @endphp
                                    <span class="badge badge-light text-info"> {{number_format( (100 - $percentused),1)}}% </span> <span class="ml-2">Remaining Budget</span>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="float-right">
                                    <a href="#" class="text-white-50"><i class="mdi mdi-briefcase-check h5"></i></a>
                                </div>
                                <p class="font-14 m-0">Balance : {{number_format( (100 - $percentused),1)}}% </p>
                            </div>
                        </div>
                    </div>
                </div>  
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Projects Report</h4>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div id="morris-line-example" class="morris-chart" style="height: 300px"></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <h5 class="font-14 mb-5">Yearly Projects Report</h5>

                                            <div>
                                                
                                               
                                                <a href="#" class="btn btn-primary btn-sm">View All <i class="mdi mdi-chevron-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Budget Analytics</h4>
                                <div id="morris-donut-example" class="morris-chart" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                    
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title mb-4">Latest Projects</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
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
                                  <?php $percentused = 0; ?>
                                  @if (array_key_exists($details->project_id,$mytotals))

                                  <?php 
                                  
                                  if($details->budget != 0){
                                    $percentused =  ($mytotals[$details->project_id]/($details->budget) * 100) ;
                                  }
                                 
                                  
                                  ?>
                                  
                                  
                                  @endif
                                  <tr>
                                    <td><a href="/finance/public/viewproject/{{$details->project_id}}">{{$details->project_name}}</a></td>
                                    
                  
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
                              <a href="/finance/public/newproject" class="btn btn-sm btn-info float-left">Add New Project</a>
                              <a href="/finance/public/projects" class="btn btn-sm btn-secondary float-right">View All Projects</a>
                            </div>
                            <!-- /.card-footer -->
                          </div>
                    </div>

                    <div class="col-xl-6">
                    
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title mb-4">Projects Approaching Deadline</h4>
                                <div class="table-responsive">
                                  
                                        <table class="table table-hover">
                                        <thead>
                                        <tr>
                                          <th>Project Name</th>
                                          <th>Deadline </th>
                                          <th>Days</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach ($projectdetils2 as $details)
                                        <?php $percentused = 0; ?>
                                        @if (array_key_exists($details->project_id,$mytotals))
                                        <?php  $percentused =  ($mytotals[$details->project_id]/($details->budget) * 100) ?>
                                        @endif
                                        <tr>
                                          <td><a href="/finance/public/viewproject/{{$details->project_id}}">{{$details->project_name}}</a></td>
                                          
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
                          <a href="/finance/public/newproject" class="btn btn-sm btn-info float-left">Add New Project</a>
                          <a href="/finance/public/projects" class="btn btn-sm btn-secondary float-right">View All Projects</a>
                        </div>
                        <!-- /.card-footer -->
                      </div>
                </div>
                </div>
                <!-- end row -->

                
               <!-- end row -->

            </div><!-- container fluid -->

        </div> <!-- Page content Wrapper -->
  

   


