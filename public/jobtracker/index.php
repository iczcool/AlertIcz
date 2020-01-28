<?php
  // include database and object files
  include_once '../../config/database.php';
  include_once '../../objects/job.php';

  // get database connection
  $database = new Database();
  $db = $database->getConnection();
  // pass connection to object
  $job = new Job($db);



  // page given in URL parameter, default page is one
  $page = isset($_GET['page']) ? $_GET['page'] : 1;

  // set number of records per page
  $records_per_page = 5;

  // calculate for the query LIMIT clause
  $from_record_num = ($records_per_page * $page) - $records_per_page;

  // retrieve records here
  // query products
  $statement = $job->readAll($from_record_num, $records_per_page);
  $num = $statement->rowCount();
?>


<?php
  $page_title = "Job Tracker::.Home";
  include_once "../inc/header.php";
?>
<!-- Content goes here -->
<div class="row">
  <div class="col-12 text-center display-4">
    <h1>Job Tracker</h1>
  </div>
  <div class="col-12">
    <a href="createjob.php">Create A Job</a>
  </div>


<?php
  // display jobs if there are any
  if($num>0){

      echo "<table class='table table-hover table-responsive table-bordered'>";
          echo "<tr>";
              echo "<th>Title</th>";
              echo "<th>Company</th>";
              echo "<th>Applied Date</th>";
              echo "<th>Expiry Date</th>";
              echo "<th>Link</th>";
              echo "<th>File</th>";
              echo "<th>Status</th>";
              echo "<th>Operation</th>";
          echo "</tr>";

          while ($row = $statement->fetch(PDO::FETCH_ASSOC)){

              extract($row);

              echo "<tr>";
                  echo "<td>{$title}</td>";
                  echo "<td>{$company}</td>";
                  echo "<td>{$applicationDate}</td>";
                  echo "<td>{$expiryDate}</td>";
                  echo "<td><a href=\"{$url}\" target=\"_blank\">{$url}</a></td>";
                  echo "<td>{$file}</td>";
                  echo "<td>{$state}</td>";

                  echo "<td>";
                  // read, edit and delete buttons
                    echo "<a href='update_product.php?id={$id}' class='btn btn-info left-margin'>
                    <span class='glyphicon glyphicon-edit'></span></a>

                    <a delete-id='{$id}' class='btn btn-danger delete-object'>
                    <span class='glyphicon glyphicon-remove'></span></a>";
                  echo "</td>";

              echo "</tr>";

          }

      echo "</table>";

      // paging buttons will be here
      // the page where this paging is used
      $page_url = "index.php?";

      // count all products in the database to calculate total pages
      $total_rows = $job->countAll();

      // paging buttons here
      include_once 'paging.php';
  }

  // tell the user there are no products
  else{
      echo "<div class='alert alert-info'>No products found.</div>";
  }
?>






</div>


<?php include_once "../inc/footer.php"; ?>
