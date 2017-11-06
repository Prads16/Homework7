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
            $query = 'SELECT * FROM accounts where id<6';
            $statement = $this->data->prepare($query);
            $statement->execute();
            $alldata = $statement->fetchAll();
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
print_r($result);

?>