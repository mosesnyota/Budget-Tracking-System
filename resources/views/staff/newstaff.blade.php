@extends('layouts.design')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">NEW STAFF</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="lastname" name ="lastname" placeholder="First Name">
                            
                          </div>

                        <div class="form-group">
                            <label for="lastname">Other Names</label>
                            <input type="text" id="lastname" name ="lastname" class="form-control" placeholder="Other Names">
                        </div>

                        <div class="form-group">
                            <label>Phone:</label>
          
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                              </div>
                              <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Staff Category</label>
                            <select class="form-control select2" style="width: 100%;">
                              <option selected="selected">Project Officers</option>
                              <option>IT</option>
                              <option>Accounts</option>
                              <option>Management</option>
                              <option>Projects</option>
                              <option>Assistants</option>
                            </select>
                          </div>

                        <!-- Date -->
                <div class="form-group">
                    <label>DOB:</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
                         

                  <div class="form-group">
                    <label>Employment Date:</label>
                      <div class="input-group date" id="dob" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#dob"/>
                          <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>

                        
                    
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email">
                          </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                    
                    
                      

                      <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                          <div class="col-sm-10">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="male" checked>
                              <label class="form-check-label" for="gridRadios1">
                                Male
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="female">
                              <label class="form-check-label" for="gridRadios2">
                                Female
                              </label>
                            </div>
                           
                          </div>
                        </div>
                      </fieldset>

                    
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                        <div class="col text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                  </form>

                </div>
            </div>
    
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
@endsection