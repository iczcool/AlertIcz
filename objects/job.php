<?php //include_once "crud.php"; ?>
<?php
/**
 *
 */
class Job {
  //database table name
  private $tableName = "jobs";
  private $conn;

  public function __construct($db){
      $this->conn = $db;
  }

  // object properties
  public $id;
  public $title;
  public $company;
  public $applicationDate;
  public $expiryDate;
  public $url;
  public $file;
  public $state;
  public $timestamp;

  // create object
   public function create(){
     //write query
       $query = "INSERT INTO " . $this->tableName . "
               SET
                  title=:title, company=:company, applicationDate=:applicationDate, expiryDate=:expiryDate, url=:url, file=:file, state=:state";

       $statement = $this->conn->prepare($query);

       // posted values
       $this->title=htmlspecialchars(strip_tags($this->title));
       $this->company=htmlspecialchars(strip_tags($this->company));
       $this->applicationDate=htmlspecialchars(strip_tags($this->applicationDate));
       $this->expiryDate=htmlspecialchars(strip_tags($this->expiryDate));
       $this->url=htmlspecialchars(strip_tags($this->url));
       $this->file=htmlspecialchars(strip_tags($this->file));
       $this->state=htmlspecialchars(strip_tags($this->state));

       // to get time-stamp for 'created' field
       $this->timestamp = date('Y-m-d H:i:s');

       // bind values
       $statement->bindParam(":title", $this->title);
       $statement->bindParam(":company", $this->company);
       $statement->bindParam(":applicationDate", $this->applicationDate);
       $statement->bindParam(":expiryDate", $this->expiryDate);
       $statement->bindParam(":url", $this->url);
       $statement->bindParam(":file", $this->file);
       $statement->bindParam(":state", $this->state);

      try {
        if($statement->execute()){
            return true;
        }else{
            return false;
        }
      } catch (Exception $e) {
        echo "OOps!". $e->getMessage()."";
      }

   }

   // used for paging products
    public function countAll(){
        $query = "SELECT id FROM " . $this->tableName . "";

        $statement = $this->conn->prepare( $query );
        $statement->execute();

        $num = $statement->rowCount();

        return $num;
    }

   // read object
   public function read(){
     //write query
       $query = "SELECT * FROM " . $this->tableName . "
               SET
                  title=:title, company=:company, applicationDate=:applicationDate, expiryDate=:expiryDate, url=:url, file=:file, state=:state";

       $statement = $this->conn->prepare($query);
   }

   public function readAll($from_record_num, $records_per_page){
    $query = "SELECT
                id, title, company, applicationDate, expiryDate, url, file, state
            FROM
                " . $this->tableName . "
            ORDER BY
                title ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";

      $statement = $this->conn->prepare( $query );
      $statement->execute();
      return $statement;
  }






   // edit object
   public function edit(){}
   // delete object
   public function delete(){}
}

?>
