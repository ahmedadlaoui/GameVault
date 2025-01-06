<?php
require_once "clsDataBase.php";
class clsAdmin
{
  private $_NickName;
  private $_Email;
  private $_Password;
  private $_ProfilePicture;
  private $_Connection;

  private function _isGameAlreadyExist($GameName): bool
  {
    try {
      $stmt = $this->_Connection->prepare("SELECT * FROM games WHERE Game_Name = :GameName LIMIT 1");
      $stmt->execute([':GameName' => $GameName]);

      // Fetch the result
      return $stmt->fetch() !== false; // Returns true if a row exists, false otherwise
    } catch (PDOException $e) {
      // Log the error
      error_log("Error checking if game exists: " . $e->getMessage());
      return false; // Return false on error
    }
  }

  public function __construct($NickName, $Email, $Password, $ProfilePicture)
  {
     $this->_NickName = $NickName;
     $this->_ProfilePicture = $ProfilePicture;
     $this->_Email = $Email;
     $this->_Password = $Password;
    $conn = new clsDataBase("gamevault", "root", "", "localHost");
    $conn->ConnectToDB();
    $this->_Connection = $conn->Connection;
  }

}
