<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

echo "<h1>Connecting to the database and retrieving value from the database</h1>";

$db= new DatabaseConn();

class DatabaseConn
{
    public $isCon;
    protected $data;
    
    public function __construct($username = "pra22", $password = "zsLR8d2wM", $host = "sql2.njit.edu", $dbname = "pra22")
    {
        $this->isCon = TRUE;
        try {
                $this->data = new PDO("mysql:host={$host};dbname={$dbname};", $username, $password);
                $this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                echo '<p> Connected to the Database successfully </p>' . '<br>';
            }
            catch (PDOException $e) 
            {
                $err_message = $e -> getMessage();
                echo "<p> Error occurred while connecting to the database: $err_message </p>" . '<br>';
            }
        
    }
 
     public function getRows()
    {
        try 
        {
            $query = $this->data->prepare('SELECT * FROM accounts where id<6');
            $query->execute();
            $count = $query->rowCount(); 
	        echo '<br>';
	        echo "The number of records are: $count" . '<br>' . '<br>';
            $alldata = $query->fetchAll();
            return $alldata;   
        }
    
        catch (PDOException $e) 
        {
            $err_message = $e -> getMessage();
            echo "<p> Error occurred while connecting to the database: $err_message </p>" . '<br>';
        }
    }

    public function Disconnect()
    {
        $this->data = NULL;
        $this->isCon = FALSE;
    }

}

$result = $db->getRows();

echo "<table border = 1>";

echo "<tr>
      <th>ID</th>
      <th>Email</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Phone</th>
      <th>Birth Date</th>
      <th>Gender</th>
      <th>Password</th>
      </tr>";

foreach( $result as $rowdata) 
 {
       echo "<tr>";
       echo "<td>" . $rowdata['id'] . "</td>";
       echo "<td>" . $rowdata['email'] . "</td>";
       echo "<td>" . $rowdata['fname'] . "</td>";
       echo "<td>" . $rowdata['lname'] . "</td>";
       echo "<td>" . $rowdata['phone'] . "</td>";
       echo "<td>" . $rowdata['birthday'] . "</td>";
       echo "<td>" . $rowdata['gender'] . "</td>";
       echo "<td>" . $rowdata['password'] . "</td>";
       echo "</tr>";
}   

echo "</table>";
    
?>