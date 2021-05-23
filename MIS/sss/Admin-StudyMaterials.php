<?php
ob_start();
set_time_limit(0);

require_once '../includes/db.inc.php';

$state  = "";
$success=0;


if (isset($_POST['btn-upload'])) {


  $filename = $_FILES['file']['name'];
  if($filename==null){
    $success=2;
    //header("Location: Admin-StudyMaterials.php");
  }

  else{

  $tmpname = $_FILES['file']['tmp_name'];
  $file_size = $_FILES['file']['size'];
  $file_type = $_FILES['file']['type'];

  $ext = pathinfo($filename, PATHINFO_EXTENSION);


  $fp      = fopen($tmpname, 'r');
  $content = fread($fp, filesize($tmpname));
  $content = addslashes($content);
  fclose($fp);


  if (
    $ext == "png" || $ext == "PNG" || $ext == "JPG" || $ext == "jpg" || $ext == "jpeg" || $ext == "JPEG"
    || $ext == "pdf" || $ext == "PDF" || $ext == "doc" || $ext == "DOC" || $ext == "docx" || $ext == "DOCX"
    || $ext == "XLS" || $ext == "xls" || $ext == "XLSX" || $ext == "xlsx" || $ext == "xlsm" || $ext == "XLSM" || $ext == "TXT"
  ) {
    $sql = "INSERT INTO tbl_uploads(filename,filetype,size,data) VALUES('$filename','$file_type','$file_size','$content')";
    $i = mysqli_query($link, $sql);

    if ($i == 1) {

      $success = 1;

      mysqli_close($link);
    } else {
      mysqli_close($link);
      $success=2;
    }
  } 
  else {
    mysqli_close($link);
    $state = 'File Format might not be supported, please check and try again';
  }
}
}


?>
<link href="css/StudyUpload.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">

  <div class="accordion" id="accordionExample">

    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Previously Uploaded Study Materials
          </button>
        </h2>
      </div>

      <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">File Name</th>
                <th scope="col">Download</th>

              </tr>
            </thead>

            <?php
            $con = mysqli_connect("localhost", "root", "", "dlms");

            $sql = "SELECT fileid , filename ,filetype FROM tbl_uploads";
            $result = mysqli_query($con, $sql);
              

            while ($row = mysqli_fetch_array($result)) {
            ?>
              <tr>
                <td><?php echo $row['fileid']; ?></td>
                <td><?php if ($row['filetype']=="application/pdf" ) {
                        echo   '<i class="fa fa-file-pdf-o" style="font-size:25px;color:red">'; echo '</i>';
                        echo   ' &nbsp'; 
                      }

                        else if($row['filetype']=="image/jpeg" || $row['filetype']=="image/png"){
                          echo   '<i class="fa fa-file-image-o" style="font-size:25px;color:black">'; echo '</i>';
                          echo   ' &nbsp'; 
                        }
                        
                          echo $row['filename'];

                        
                ?> 
                </td>
  

                <td><a href="download.php?id=<?php echo urlencode($row['fileid']); ?>"
                   ><?php $row['filename'];?><i class="fa fa-download"></i></a></td>
              </tr>
            <?php
            }
            ?>

          </table>



        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Upload New Study Materials
          </button>
        </h2>
      </div>

      <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <!-- Upload  -->

                     <!-- The Modal -->
          <div class="modal" id="myModal1">
            <div class="modal-dialog">
              <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Upload Status</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                Upload Failed : Please select the file correctly
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
          </div>

          <!-- The Modal  Fail-->
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Upload Status</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                Successfully Uploaded
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
                
              </div>
            </div>
          </div>

          <?php

          if ($state != null) {
            echo '<br/> <div class="alert alert-danger alert-dismissible fade show uploader" role="alert" >';
            echo $state;
            echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>';
            echo '<br>';
          }

          ?>



            <form class="uploader" action="#" method="post" enctype="multipart/form-data">

              <label for="file-upload" class="outer">
                <img id="file-image" src="#" alt="Preview" class="hidden">
                <div id="start">

                <label for ="select">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <div>Select a file</div>
                  </label>
                  <input type='file' id="select" style="display:none" name="file">
                </div>

                <div>

                <p id="chosenfile"></p>
                  <button type="submit" name="btn-upload" class=btn btn-primary>upload</button>


                </div>

              </label>
            </form>
        </div>
      </div>
    </div>

    

  </div>
</div>
<script>
 var success=0;
  success = '<?php echo $success; ?>';
if(success==1){

$('#myModal').modal('show');

}


else if (success==2){
  $('#myModal1').modal('show');
}

</script>
<script>
  var input = document.getElementById('select');
  var infoArea = document.getElementById('chosenfile');

  input.addEventListener('change',showFileName);

  function showFileName(event){
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = 'Selected File: ' + fileName;
  }
</script>

<?php

//require_once 'admin-footer.php';
?>