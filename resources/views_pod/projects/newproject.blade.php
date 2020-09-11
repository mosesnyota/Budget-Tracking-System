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
                <h3 class="card-title">New Project</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="savenewproject" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name">
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label for="location" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="location" name="location" placeholder="Project Location">
                    </div>
                  </div>
                    
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                  
                 <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Set Deadline</label>
                    <div class="col-sm-10">
                      <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                  </div>
                    <div class="form-group row">
                        <label for="sponsor_id" class="col-sm-2 col-form-label">Funded By</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="sponsor_id" style="width: 100%;">
                                <option value="">----Select Project Sponsor-----</option>
                                @foreach ($sponsors as $sponsor)
                                  <option value="{{$sponsor -> sponsor_id}}">{{$sponsor -> sponsornames}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="staff_id" class="col-sm-2 col-form-label">Assigned to:</label>
                      <div class="col-sm-10">
                          <select class="form-control select2" name="staff_id" id="staff_id" style="width: 100%;">
                              <option value="">----Select Project Sponsor-----</option>
                              @foreach ($staffs as $staff)
                                <option value="{{$staff -> staffid}}">{{$staff -> firstname ." ". $staff -> othernames}}</option>
                              @endforeach
                              
                          </select>
                      </div>
                  </div>
                    
                
                
                <div class="form-group row">
                    <label for="budget" class="col-sm-2 col-form-label">Total Budget</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="budget" name="budget" placeholder="Estimated Budget">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="details" class="col-sm-2 col-form-label">Project Details</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" name="details" id="details" placeholder="Details"></textarea>
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



