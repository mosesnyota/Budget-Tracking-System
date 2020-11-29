
  <div class="modal fade bs-example-modal-lg" id="modal-changepassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="password/change" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                   

                    <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">Old Password:</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" name="oldpassword" id="oldpassword " class="form-control" required>
                                </div>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">New Password:</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" name="newpassword" id="newpassword" class="form-control" required >
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">Confirm New Password:</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" name="confirmedpassword" id="confirmedpassword" class="form-control"  required>
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


