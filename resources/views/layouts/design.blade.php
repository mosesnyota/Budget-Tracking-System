<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ProNet ERP</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- morris css -->
        <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">


        <!-- DataTables -->
        <link href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

         <!-- Plugins css -->
         <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
         <link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
         <link href="{{asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    </head>


    <body class="fixed-left">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.leftmenu')
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->

    <div class="content-page">

    <div class="content">
                    <!-- Top Bar Start -->
        <div class="topbar">

            <div class="topbar-left	d-none d-lg-block">
                <div class="text-center">
                    
                </div>
            </div>

            <nav class="navbar-custom">

                 <!-- Search input -->
                 <div class="search-wrap" id="search-wrap">
                    <div class="search-bar">
                        <input class="search-input" type="search" placeholder="Search" />
                        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                            <i class="mdi mdi-close-circle"></i>
                        </a>
                    </div>
                </div>

                <ul class="list-inline float-right mb-0">
                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                            <i class="mdi mdi-magnify noti-icon"></i>
                        </a>
                    </li>

                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline noti-icon"></i>
                            <span class="badge badge-danger badge-pill noti-icon-badge"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg dropdown-menu-animated">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5>Notification (1)</h5>
                            </div>

                            <div class="slimscroll-noti">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>A project is approaching deadline</b><span class="text-muted">One project needs your attention. Check the projects section.</span></p>
                                </a>

                            </div>
                            

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item notify-all">
                                View All
                            </a>

                        </div>
                    </li>


                    <li class="list-inline-item dropdown notification-list nav-user">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/avatar-6.jpg" alt="user" class="rounded-circle">
                            <span class="d-none d-md-inline-block ml-1"> {{Auth::user()->name}}<i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                            <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i>Profile</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted"></i>Change Password</a>
                            <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i>Lock screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="dripicons-exit text-muted"></i> Logout</a>

                        </div>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                </form>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="list-inline-item">
                        <button type="button" class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <li class="list-inline-item dropdown notification-list d-none d-sm-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                            Create New <i class="mdi mdi-plus"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated">
                            <a class="dropdown-item" href="#"> <i class="dripicons-graph-pie"></i> New Project</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> <i class="dripicons-user text-muted"></i> New Staff</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"> <i class="dripicons-user-group text-muted"></i> New Financier</a>
                        </div>
                    </li>
                    <li class="list-inline-item notification-list d-none d-sm-inline-block">
                        <a href="pettycash" class="nav-link waves-effect">
                            Petty Cash
                        </a>
                    </li>

                </ul>


            </nav>

        </div>
        @yield('content')
        <!-- Top Bar End -->
    </div> <!-- content -->
    <footer class="footer">
         © 2020 Don Bosco Development Office <span class="d-none d-md-inline-block"> </i></span>
    </footer>
</div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('assets/js/detect.js')}}"></script>
        <script src="{{asset('assets/js/fastclick.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{asset('plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>

        <!-- dashboard js -->
        <script src="{{asset('assets/pages/dashboard.int.js')}}"></script>        

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>


        
    

        <!-- Required datatable js -->
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/pdfmake.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/vfs_fonts.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/buttons.colVis.min.js')}}"></script>
        <!-- Responsive examples -->
        <script src="{{asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{asset('assets/pages/datatables.init.js')}}"></script>        

       
        <!-- Plugins js -->
        <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>   
        
        <!-- Plugins Init js -->
        <script src="{{asset('assets/pages/form-advanced.js')}}"></script>
        

<!-- Dropzone js -->
<script src="{{asset('plugins/dropzone/dist/dropzone.js')}}"></script>


<!-- page script -->
<script>
  $(function () {
    /* jQueryKnob */

    $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $('.sparkline').each(function () {
      var $this = $(this)
      $this.sparkline('html', $this.data())
    })

    /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines()
    drawMouseSpeedDemo()

  })

  function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {
      type    : 'bar',
      barColor: '#aaf'
    })
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
      {
        composite: true,
        fillColor: false,
        lineColor: 'red'
      })


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline()

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
      {
        type  : 'line',
        height: '2.5em',
        width : '4em'
      })

    // Customized line chart
    $('#linecustom').sparkline('html',
      {
        height      : '1.5em',
        width       : '8em',
        lineColor   : '#f00',
        fillColor   : '#ffa',
        minSpotColor: false,
        maxSpotColor: false,
        spotColor   : '#77f',
        spotRadius  : 3
      })

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', { type: 'bar' })

  

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', { type: 'tristate' })
    $('.sparktristatecols').sparkline('html',
      {
        type    : 'tristate',
        colorMap: {
          '-2': '#fa7',
          '2' : '#44f'
        }
      })

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {
      fillColor     : false,
      changeRangeMin: 0,
      chartRangeMax : 10
    })
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
      {
        composite     : true,
        fillColor     : false,
        lineColor     : 'red',
        changeRangeMin: 0,
        chartRangeMax : 10
      })

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
      {
        fillColor     : false,
        normalRangeMin: -1,
        normalRangeMax: 8
      })
    $('#normalExample').sparkline('html',
      {
        fillColor       : false,
        normalRangeMin  : 80,
        normalRangeMax  : 95,
        normalRangeColor: '#4f4'
      })

    // Discrete charts
    $('.discrete1').sparkline('html',
      {
        type     : 'discrete',
        lineColor: 'blue',
        xwidth   : 18
      })
    $('#discrete2').sparkline('html',
      {
        type          : 'discrete',
        lineColor     : 'blue',
        thresholdColor: 'red',
        thresholdValue: 4
      })

    // Bullet charts
    $('.sparkbullet').sparkline('html', { type: 'bullet' })

    // Pie charts
    $('.sparkpie').sparkline('html', {
      type  : 'pie',
      height: '1.0em'
    })

    // Box plots
    $('.sparkboxplot').sparkline('html', { type: 'box' })
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
      {
        type        : 'box',
        raw         : true,
        showOutliers: true,
        target      : 6
      })

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
      type                     : 'box',
      tooltipFormatFieldlist   : ['med', 'lq', 'uq'],
      tooltipFormatFieldlistKey: 'field'
    })

    // click event demo sparkline
    $('.clickdemo').sparkline()
    $('.clickdemo').bind('sparklineClick', function (ev) {
      var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
      value         = region.y
      alert('Clicked on x=' + region.x + ' y=' + region.y)
    })

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline()
    $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
      var sparkline = ev.sparklines[0],
          region    = sparkline.getCurrentRegionFields()
      value         = region.y
      $('.mouseoverregion').text('x=' + region.x + ' y=' + region.y)
    }).bind('mouseleave', function () {
      $('.mouseoverregion').text('')
    })
  }

  /**
   ** Draw the little mouse speed animated graph
   ** This just attaches a handler to the mousemove event to see
   ** (roughly) how far the mouse has moved
   ** and then updates the display a couple of times a second via
   ** setTimeout()
   **/
  function drawMouseSpeedDemo() {
    var mrefreshinterval = 500 // update display every 500ms
    var lastmousex       = -1
    var lastmousey       = -1
    var lastmousetime
    var mousetravel      = 0
    var mpoints          = []
    var mpoints_max      = 30
    $('html').mousemove(function (e) {
      var mousex = e.pageX
      var mousey = e.pageY
      if (lastmousex > -1) {
        mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey))
      }
      lastmousex = mousex
      lastmousey = mousey
    })
    var mdraw = function () {
      var md      = new Date()
      var timenow = md.getTime()
      if (lastmousetime && lastmousetime != timenow) {
        var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000)
        mpoints.push(pps)
        if (mpoints.length > mpoints_max) {
          mpoints.splice(0, 1)
        }
        mousetravel = 0
        $('#mousespeed').sparkline(mpoints, {
          width        : mpoints.length * 2,
          tooltipSuffix: ' pixels per second'
        })
      }
      lastmousetime = timenow
      setTimeout(mdraw, mrefreshinterval)
    }
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
  }
</script>



<!-- Page script -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date range picker
    $('#projectstartdate').datetimepicker({
        format: 'L'
    });

    $('#activityenddate').datetimepicker({
        format: 'L'
    });

    

    //Date range picker
    $('#projectenddate').datetimepicker({
        format: 'L'
    });
    

    $('#datetimepicker4').datetimepicker({
        format: 'L'
    });
    
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

<script>
  $(function () {
      var tbl = $("#stafftable");
      $("#stafftable").DataTable({
          "responsive": true,
          "autoWidth": false,
          "bInfo" : false,
          
      });
      $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
      });
  });
</script>

<script>

$(function () {
      var tbl = $("#datatablewwww2");
      $("#datatablewwww2").DataTable({
          "responsive": true,
          "autoWidth": false,
          "bInfo" : false,
          
      });
  });
</script>


<script>
  $(function () {
      var tbl = $("#nobuttonstable");
      $("#nobuttonstable").DataTable({
          "responsive": true,
          "autoWidth": false,
      });
      $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
      });
  });
</script>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'details' );
</script> 

<div class="modal fade" id="modal-issuefunds">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Issue Funds</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form role="form" method="post" action="pettycash/store" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                  <div class="box-body"> 
                      <div class="form-group">
                          <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                              <input type="text" name="transaction_date" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                              <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>


                      <div class="form-group">
                          <label>Issued to: </label>
                          <select class="form-control select2" name ="issuedto" id ="issuedto" style="width: 100%;" required>
                              <option value="">------Select Person------</option>
                              <option value="Non Employee">Non Employee</option>

                          </select>
                      </div>
                      <label>Amount: </label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                          </div>
                          <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
                      </div>

                      <div class="form-group">
                          <label>Comment: </label>
                          <input type="text" name="description" id="description" class="form-control" placeholder="Comment">
                      </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="modal-footer justify-content-between">
                      <input type="hidden" name="transactiontype" value="Withdraw" >
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



<div class="modal fade" id="modal-addfunds">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Add Funds to Petty Cash</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form role="form" method="post" action="pettycash/store" enctype="multipart/form-data" >
                  {{ csrf_field() }}
                  <div class="box-body"> 
                      <div class="form-group">
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="text" name="transaction_date" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                      </div>
                      <label>Amount: </label>
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-dollar"></i></span>
                          </div>
                          <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
                      </div>

                      <div class="form-group">
                          <label>Comment: </label>
                          <input type="text" name="description" id="description" class="form-control" placeholder="Comment">
                      </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="modal-footer justify-content-between">
                      <input type="hidden" name="transactiontype" value="Deposit" >
                      <input type="hidden" name="issuedto" value="-" >
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


<script>
  $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            var activityname  = $('#'+id).children('td[data-target=activityname]').text();
            $('#userd').val(activityname);
            $('#userId').val(id);
            $('#modal-markactivity').modal('toggle');
      });
    });
</script>


<script>
  $(document).ready(function(){
    //  append values in input fields
      $(document).on('click','a[data-role=updatedispersementvotehead]',function(){
            var id  = $(this).data('id');
            var activityname  = $('#'+id).children('td[data-target=narrationname]').text();
            $('#narration22').val(activityname);
            $('#disbursmentid').val(id);
            $('#modal-assignvotehead').modal('toggle');
      });
    });
</script>



@include('sweetalert::alert')

<script type="text/javascript">
  $("body").on("click",".deledisburse",function(){
    var current_object = $(this);
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "error",
        showCancelButton: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
    },function (result) {
        if (result) {
            var action = current_object.attr('data-action');
            var token = jQuery('meta[name="csrf-token"]').attr('content');
            var id = current_object.attr('data-id');

            $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
            $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
            $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
            $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
            $('body').find('.remove-form').submit();
        }
    });
});
</script>


<script>
$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>

<script>
      jQuery('#datepicker-deadline').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        jQuery('#datepicker-startdate').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        jQuery('#datepicker-projectstart').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        jQuery('#datepicker-projectdeadline').datepicker({
            autoclose: true,
            todayHighlight: true
        });
</script>

    </body>
</html>