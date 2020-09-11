

<div class="modal fade" id="modal-addvotehead">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Votehead</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/blog/public/votehead/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        <div class="form-group">
                          <div class="form-group">
                            <label>Votehead: </label>
                            <input type="text" name="votehead_name" id="votehead_name" class="form-control" placeholder="Votehead">
                        </div>
                        </div>
                        <label>Amount: </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                            </div>
                            <input type="number" name="amount_allocated" id="amount_allocated" class="form-control" placeholder="Amount">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="project_id" value="{{$project->project_id}}" >
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
<div class="modal fade" id="modal-dispersfunds">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Record Issued Project Funds</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/blog/public/disbursment/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
  
                      <div class="form-group">
                        <label>Funds Issued On </label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="disbursment_date" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                       </div>
  
                       <div class="form-group">
                        <div class="form-group">
                          <label>Votehead </label>
                          <select class="form-control select2" name="votehead_id" style="width: 100%;">
                            <option value=""></option>
                            @foreach ($voteheads as $votehead)
                              <option value="{{$votehead ->votehead_id}}">{{$votehead ->votehead_name}}</option>
                            @endforeach
                            
                        </select>
                      </div>
                      </div>
                        <label>Amount </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                            </div>
                            <input type="number" name="disbursment_amount" id="disbursment_amount" class="form-control" placeholder="Amount">
                        </div>
  
                        <div class="form-group">
                          <div class="form-group">
                            <label>Reference </label>
                            <input type="text" name="reference" id="reference" class="form-control" placeholder="Comment/Reference">
                        </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="project_id" value="{{$project->project_id}}" >
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



  <div class="modal fade" id="modal-addactivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Critical Milestone</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/blog/public/activity/store" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                        <div class="form-group">
                          <div class="form-group">
                            <label>Activity Name </label>
                            <input type="text" name="activityname" id="activityname" class="form-control" placeholder="Activity Name">
                        </div>
                        </div>

                        

                        
                        
                        <div class="form-group">
                            <label>Start Date</label>
                            <div class="input-group date" id="projectstartdate" data-target-input="nearest">
                                <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#projectstartdate"/>
                                <div class="input-group-append" data-target="#projectstartdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                           </div>

                           <div class="form-group">
                            <label>Deadline Date</label>
                            <div class="input-group date" id="projectenddate" data-target-input="nearest">
                                <input type="text" name="deadline_date" class="form-control datetimepicker-input" data-target="#projectenddate"/>
                                <div class="input-group-append" data-target="#projectenddate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                           </div>

                </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="project_id" value="{{$project->project_id}}" >
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>





  <div class="modal fade" id="modal-markactivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mark Milestone Complete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <form role="form" method="post" action="/blog/public/activity/update/1" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="box-body"> 
                       
                        <div class="form-group">
                            <div class="form-group">
                              <label>Activity Name </label>
                              <input type="text" name="userd" id="userd" disabled class="form-control" >
                          </div>
                          </div>

                          <div class="form-group">
                            
                            <div class="form-group">
                                <label for="curstatus" class="col-sm-2 col-form-label">Status</label>
                                <select class="form-control select2" name="curstatus" id="curstatus" style="width: 100%;">
                                    <option value="ongoing">Ongoing</option>
                                    <option value="Completed">Completed</option>
                                    <option value="onhold">On Hold</option>
                                </select>
                            </div>
                        </div>

        
                        
                        <div class="form-group">
                            <label>Date Completed</label>
                            <div class="input-group date" id="activityenddate" data-target-input="nearest">
                                <input type="text" name="activityenddate" class="form-control datetimepicker-input" data-target="#activityenddate"/>
                                <div class="input-group-append" data-target="#activityenddate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                           </div>
                </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                    <input type="hidden" name="userId" id="userId" class="form-control" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>           
            </div>
  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>