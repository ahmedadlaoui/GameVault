<?php 
 class clsDataBase{
  private $_DBName="test_db";
  private $_DBUser="root";
  private $_DBPassword="";
  private $_DBHost="localhost";
  public $Connection;


  public function __construct($DBName,$DBUser,$DBPassword,$DBHost)
  {
    $this->_DBName=$DBName;
    $this->_DBPassword=$DBPassword;
    $this->_DBUser=$DBUser;
    $this->_DBHost=$DBHost;
  }
  public function ConnectToDB():bool
  {
    try{
      $this->Connection=new PDO("mysql:host=" .$this->_DBHost . ";dbname=" . $this->_DBName, $this->_DBUser, $this->_DBPassword);
      $this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
    
    }catch(PDOException $err){
      echo "database connection problem : " .$err->getMessage();
      return false;
    }
    return true;
  }

 }

?>