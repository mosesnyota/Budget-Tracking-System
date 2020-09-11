@extends('layouts.design')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            
          </div>
          <div class="col-sm-2">
            <button type="button" class="btn btn-secondary btn-lg float-right"  data-toggle="modal" data-target="#modal_newstaff"> <b class="fa fa-plus-circle"> Add User </b></button>
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
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $counter = 1 ; ?>
                    @if(count($staffs) > 0)
                    @foreach($staffs as $staff)
                            <tr>
                                <td>{{$counter}}</td>
                                <td>{{$staff -> firstname}} {{" "}}{{$staff -> othernames}}</td>
                                <td>{{$staff -> phone}}</td>
                                <td>{{$staff -> email}}</td>
                                
                                <td><a href="staffs/{{$staff ->staffid}}/edit" title="Click to Edit Customer Details"><i  <button type="button" class="btn btn-success hvr-icon-float-away btn-sm btn-md"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a></td>
                                <td> <a href="#" onclick="return WarningDelete(1);" title="Click To Delete"><i <button type="button" class="btn btn-danger btn-sm hvr-icon-sink-away"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></i></a></td>		

                                
                                
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


<div class="modal fade" id="modal_newstaff">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="staff/store" enctype="multipart/form-data" >
          {{ csrf_field() }}
          <div class="card-body">

              <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" id="firstname" name ="firstname" placeholder="First Name" required>
                  
                </div>

              <div class="form-group">
                  <label for="othernames">Other Names</label>
                  <input type="text" id="othernames" name ="othernames" class="form-control" placeholder="Other Names" required>
              </div>

              <div class="form-group">
                  <label>Phone:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="phone"  id="phone" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
                  </div>
                  <!-- /.input group -->
              </div>

              <div class="form-group">
                  <label>Staff Category</label>
                  <select class="form-control select2" name ="staffcategory_id" id ="staffcategory_id" style="width: 100%;" required>
                    <option value="">------Select Category------</option>
                    <option value="5">IT</option>
                    <option value="2">Accounts</option>
                    <option value="1">Management</option>
                    <option value="5">Assistants</option>
                    <option value="3">Project Officer</option>
                  </select>
                </div>

              
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email">
              </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
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

