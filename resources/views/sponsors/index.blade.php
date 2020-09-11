@extends('layouts.design')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <button type="button" class="btn btn-success btn-lg float-right"  data-toggle="modal" data-target="#modal-addsponsor"> <b class="fa fa-plus-circle"> New Record </b></button>
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
                <table id="stafftable" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th>Name/Organization</th>
                    <th>Contact Person</th>
                    <th>Joined</th>
                    <th>Phone</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $counter = 1 ; ?>
                    @if(count($sponsors) > 0)
                    @foreach($sponsors as $transaction)
                            <tr>
                                <td>{{$counter}}</td>
                                <td>{{$transaction -> sponsornames}}</td>
                                <td>{{$transaction -> contactperson}}</td>
                                <td>{{$transaction -> startdate}}</td>
                                <td>{{$transaction -> phone}}</td>
                                <td><button type="button" class="btn btn-secondary btn-sm mr-1"><i class="fa fa-edit"> Edit </i></button></td>
                                <td><button type="button" class="btn btn-secondary btn-sm mr-1"><i class="fa fa-trash"> Delete</i></button></td>
                                 <?php $counter += 1 ; ?>
                            </tr>
                        @endforeach 
                @endif
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


<div class="modal fade" id="modal-addsponsor">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Project Sponsor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                <form role="form" method="post" action="sponsors/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        
                        <div class="form-group">
                            <label>Name/Organization: </label>
                            <input type="text" name="sponsornames" id="sponsornames" class="form-control" placeholder="Name/Organization">
                        </div>
                        
                         <div class="form-group">
                            <label>Contact Person: </label>
                            <input type="text" name="contactperson" id="contactperson" class="form-control" placeholder="Contact Person">
                         </div>
                        
                        <div class="form-group">
                            <label>Address: </label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                         </div>
                        
                        <div class="form-group">
                            <label>Email: </label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                         </div>
                        
                        <div class="form-group">
                            <label>Phone: </label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                        </div>
                        
                        
                        <div class="form-group">
                            <label>Start Date: </label>
                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                <input type="text" name="startdate" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>           
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

