<?php
// this can be use to any projects 
// not depends on any projects or application
class Database{
    // create properties
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    //now we want a few properties to
    // because we need database handler
    private $dbh;
    private $error;
    private $stmt;

    //build a method constructer
    public function __construct(){
        //set DSN
        // basically a connection string that
        // include host and database name  
        // PDO = PHP Database object
        // you can use other database with pdo, posgrad is one of them
    
        $dsn = 'mysql:host='. $this->host .';dbname='. $this->dbname;

        //set options
        $options = array(
            PDO::ATTR_PERSISTENT =>true,
            PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION

        );

        //PDO Instance
        //dbh stands for database handler
        // new = PDO || is istantiate the PDO --> we want to pass in the DSN variable 
        // this is where we want to put our pssword and username
        try{
            $this->dbh= new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch(PDOException $e)
        {
            //error message we will put it in inside the error property
            $this->error = $e->getMessage();
        }
    }

        //build a method query
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    //build a method that will working and bind those values
    public function bind($param, $value, $type = null){
        // if the type is null
        if(is_null($type)){
                switch(true){
                    case is_int ($value) :
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool ($value) :
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null ($value) :
                        $type = PDO::PARAM_NULL;
                        break;
                    default : 
                        $type = PDO::PARAM_STR;
                }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }
    //to fetch the data from database and return is as an object
    // one of the easier function PDO

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    // responsible to fetch for a single value 
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
}