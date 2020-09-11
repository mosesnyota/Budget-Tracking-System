@extends('layouts.design')
@section('content')
<div class="content-wrapper">
    
    <section class="content-header">
      
    </section>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                     <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Project</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form class="form-horizontal" method="post" action="/blog/public/saveupdatedproject/{{$project->project_id}}" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="project_name" name="project_name" value="{{$project ->project_name}}">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="location" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="location" name="location" value="{{$project ->location}}">
                    </div>
                  </div>
                    
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Start Date</label>
                    <script>
                      $('#editdated1').datetimepicker({ format: 'L'});
                      $('#editdated1').data("DateTimePicker").date(moment( $project->start_date).format('MM/DD/YY')); 
        
                    </script>
                    <div class="col-sm-10">
                      <div class="input-group date" id="editdated1" data-target-input="nearest">
                            <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#editdated1" value="{{$project ->start_date}}"/>
                            <div class="input-group-append" data-target="#editdated1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  
                 <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Set Deadline</label>
                    <div class="col-sm-10">
                        <script>
                            
                            $('#editdated').datetimepicker({ format: 'L'});
                            $('#editdated').data("DateTimePicker").date(moment( $project->deadline).format('DD/MM/YYYY')); 
                             </script>
                      <div class="input-group date" id="editdated" data-target-input="nearest">
                                  
                            <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#editdated" value="{{$project ->deadline}}"/>
                            <div class="input-group-append" data-target="#editdated" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Funded By</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="sponsor_id" style="width: 100%;">
                                @foreach ($sponsors as $sponsor)
                                    @if ($sponsor->sponsor_id == $project ->sponsor_id)
                                      <option selected value="{{$sponsor -> sponsor_id}}">{{$sponsor -> sponsornames}}</option>
                                    @else
                                    <option value="{{$sponsor -> sponsor_id}}">{{$sponsor -> sponsornames}}</option>
                                   @endif
                                  
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="staff_id" class="col-sm-2 col-form-label">Assigned to:</label>
                      <div class="col-sm-10">
                          <select class="form-control select2" name="staff_id" id="staff_id" style="width: 100%;">
                             
                              @foreach ($staffs as $staff)
                                   @if ($staff ->staffid == $project ->staff_id)
                                   <option selected value="{{$staff -> staffid}}">{{$staff ->firstname ." ". $staff ->othernames}}</option>
                                   @else
                                   <option value="{{$staff -> staffid}}">{{$staff ->firstname ." ". $staff ->othernames}}</option>
                                   @endif

                                
                              @endforeach
                              
                          </select>
                      </div>
                  </div>
                    
                
                
                <div class="form-group row">
                    <label for="budget" class="col-sm-2 col-form-label">Total Budget</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="budget" name="budget" value="{{$project ->budget}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="details" class="col-sm-2 col-form-label">Project Details</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" name="details" id="details" >{{$project ->details}}</textarea>
                    </div>
                </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-secondary">Save Project</button>
                    </div>
                  
                </div>
                
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

