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

  public function addNewGame($GameName, $PosterURL, $Category, $ReleaseDate): bool
  {
    if ($this->_isGameAlreadyExist($GameName)) {
      echo "game already exists!";
      return false;
    }

    try {
      $stmt = $this->_Connection->prepare("INSERT INTO games (Game_Name, Poster, Game_Category, Relese_Date) 
                                             VALUES (:GameName, :PosterURL, :Category, :ReleaseDate)");

      $stmt->execute([
        ':GameName' => $GameName,
        ':PosterURL' => $PosterURL,
        ':Category' => $Category,
        ':ReleaseDate' => $ReleaseDate
      ]);

      return true;
    } catch (PDOException $e) {
      error_log("oops! something went wrong with adding new game: " . $e->getMessage());
      return false;
    }
  }

  public function deleteGame($GameName): bool
  {
    if (!$this->_isGameAlreadyExist($GameName)) {
      echo "game doesn't exist!";
      return false;
    }
    try {
      $stmt = $this->_Connection->prepare("DELETE FROM games WHERE Game_Name=:GameName;");
      $stmt->execute([':GameName' => $GameName]);
      return true;
    } catch (PDOException $e) {
      error_log("oops! couldn't delete the game: " . $e->getMessage());
      return false;
    }
  }




}
