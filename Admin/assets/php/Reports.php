<?php

require_once 'admin-header.php';



// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin_admin'])) {
  header('Location: Admin-Login.php');
  exit;
}



?>

<script src="Header/vendors/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<!-- page content -->
<div class="right_col" role="main">

  <div class="accordion" id="accordionExample">


  <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseN" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On New License Issual

          </button>
        </h2>
      </div>

      <div id="collapseN" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="mb-5 col-md-8">

          <form method="post" action="new_issued_export.php">
                    <div class="input-daterange">
                        <div class="col-md-4 mt-2">
                            <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                        </div>
                        <div class="col-md-4 mt-2">
                            <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <input type="submit" name="export" value="Export as PDF" class="btn btn-info btn-sm" />
                    </div>
                </form>

          </div>
          <br>



        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseR" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On License Renewal

          </button>
        </h2>
      </div>

      <div id="collapseR" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="mb-5 col-md-8">
            <form method="post" action="renew_issued_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="From" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="To" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export as PDF" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
          <br>



        </div>
      </div>
    </div>



    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Details Of Registered Users

          </button>
        </h2>
      </div>

      <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="mb-5 col-md-8">
            <form method="post" action="users_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="ustart_date" class="form-control" readonly placeholder="From" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="uend_date" class="form-control" readonly placeholder="To" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export_users" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
          <br>



        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Details Of Registered Driving Schools
          </button>
        </h2>
      </div>

      <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>

          <div class="col-md-8 mb-5">

            <form method="post" action="learners_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header" id="heading3">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Approved New License Applications
          </button>
        </h2>
      </div>

      <div id="collapse3" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="col-md-8 mb-5">
            <form method="post" action="approved_newlicense_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="heading3">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapser" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Rejected New License Applications
          </button>
        </h2>
      </div>

      <div id="collapser" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="col-md-8 mb-5">
            <form method="post" action="rejected_newlicense_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="heading4">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Approved License Renewal Applications </button>
        </h2>
      </div>

      <div id="collapse4" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="col-md-8 mb-5">
            <form method="post" action="renew_approved_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Rejected License Renewal Applications </button>
        </h2>
      </div>

      <div id="collapse5" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="col-md-8 mb-5">
            <form method="post" action="renew_rejected_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Written Exam Results </button>
        </h2>
      </div>

      <div id="collapse6" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <p class="h6 font-weight-bold">Please choose the date range</p>
          <div class="col-md-8 mb-5">
            <form method="post" action="written_exam_results_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Trial Exam Results
      </div>

      <div id="collapse7" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <div class="col-md-8 mb-5">
            <form method="post" action="trial_results_export.php">

              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Report On Payments </button>
        </h2>
      </div>

      <div id="collapse9" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">

        <p class="h5 font-weight-bold">Payments Regarding New License</p>

          <p class="h6 font-weight-bold">Please choose the date range</p>
<div class="row">
          <div class="col-md-8 mb-5">
            <form method="post" action="new_payments_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>
          </div>
          <p class="h5 font-weight-bold">Payments Regarding  License Renewal</p>

          
          <p class="h6 font-weight-bold">Please choose the date range</p>

          <div class="col-md-8 mb-5">
            <form method="post" action="renew_payments_export.php">
              <div class="input-daterange">
                <div class="col-md-4 mt-2">
                  <input type="text" name="start_date" class="form-control" readonly placeholder="start date" />
                </div>
                <div class="col-md-4 mt-2">
                  <input type="text" name="end_date" class="form-control" readonly placeholder="end date" />
                </div>
              </div>
              <div class="col-md-2 mt-2">
                <input type="submit" name="export" value="Export to Excel" class="btn btn-info btn-sm" />
              </div>
            </form>
          </div>


        </div>
      </div>
    </div>





  </div>
</div>

<script>
  $(document).ready(function() {
    $('.input-daterange').datepicker({
      todayBtn: 'linked',
      format: "yyyy-mm-dd",
      autoclose: true
    });
  });
</script>

<!-- footer content -->
<footer>
  <div class="pull-right">
    Driving License Management System
  </div>
  <div class="clearfix"></div>
</footer>

<!-- /footer content -->

<!-- jQuery -->


<!-- Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="Header/build/js/custom.min.js"></script>

</body>

</html>