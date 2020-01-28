<?php
  // include database and object files
  include_once '../../config/database.php';
  include_once '../../objects/job.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();
  // pass connection to object
  $job = new Job($db);
?>

<?php
  $page_title = "Job Tracker::.Create Job";
  include_once "../inc/header.php";
?>
<!-- Content goes here -->
<div class="row">
  <div class="col-12 text-center display-4">
    <h1>Create A Job</h1>
  </div>
  <div class="">
    <?php
      echo "<a href='index.php'>Read Jobs</a>";
     ?>
</div>





<!-- PHP post code-->
<?php
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){

    // set job property values
    $job->title = $_POST['title'];
    $job->company = $_POST['company'];
    $job->applicationDate = $_POST['applicationDate'];
    $job->expiryDate = $_POST['expiryDate'];
    $job->url = $_POST['url'];
    $job->file = $_POST['file'];
    $job->state = $_POST['state'];

    // create the job
    if($job->create()){
        echo "<div class='alert alert-success'>Job was created.</div>";
    }
    // if unable to create the job
    else{
        echo "<div class='alert alert-danger'>Unable to create the job.</div>";
    }
}
?>




<!-- HTML form for creating a job -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Title</td>
            <td><input type='text' name='title' class='form-control' /></td>
        </tr>

        <tr>
            <td>Company</td>
            <td><input type='text' name='company' class='form-control' /></td>
        </tr>

        <tr>
            <td>Applied Date</td>
            <td><input type="date" name='applicationDate' class='form-control'></date></td>
        </tr>

        <tr>
            <td>Expiry Date</td>
            <td><input type="date" name='expiryDate' class='form-control'></td>
        </tr>

        <tr>
            <td>Link</td>
            <td><input type='text' name='url' class='form-control' /></td>
        </tr>

        <tr>
            <td>File</td>
            <td><input type='text' name='file' class='form-control' /></td>
        </tr>

        <tr>
          <td>State</td>
          <td>
            <select class="form-control" name="state">
              <option value="begin">To Begin</option>
              <option value="incomplete">Incomplete</option>
              <option value="complete">Complete</option>
            </select>
          </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>

    </table>
</form>

<?php include_once "../inc/footer.php"; ?>
