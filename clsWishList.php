<?php
require_once "dbconn.php";
require_once "clsDataBase.php";
require_once "clsAdmin.php";
class clsWishList
{
  private $_ID;
  private $_UserID;
  private $_Connection;

  private function _doesGameBelongToWishlist($GameID, $ListID): bool
{

    if (!$this->_IsGameAlreadyExist($GameID) || !$this->_IsListExist($ListID)) {
        return false;
    }

    try {
        $stmt = $this->_Connection->prepare("SELECT * FROM wish_lists_join WHERE Game_ID = :GameID AND Wish_List_ID = :ListID LIMIT 1");
        $stmt->bindParam(':GameID', $GameID, PDO::PARAM_INT);
        $stmt->bindParam(':ListID', $ListID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch() !== false;
    } catch (PDOException $err) {
        error_log("Error checking if the game belongs to this wishlist: " . $err->getMessage());
        return false;
    }
}
  private function _IsUserExists($UserID): bool
  {
    try {
      $stmt = $this->_Connection->prepare("SELECT * FROM users where User_ID = :UserID LIMIT 1");
      $stmt->execute([':UserID' => $UserID]);
      return $stmt->fetch() !== false;
    } catch (PDOException $err) {
      error_log("Error checking if user exists: " . $err->getMessage());
      return false;
    }
  }
  private function _IsListExist($ListID): bool
  {
    try {
      $stmt = $this->_Connection->prepare("SELECT * FROM wish_lists WHERE Wish_List_ID = :ListID LIMIT 1");
      $stmt->execute([':ListID' => $ListID]);
      return $stmt->fetch() !== false;
    } catch (PDOException $err) {
      error_log("Error checking if user exists : " . $err->getMessage());
      return false;
    }
  }

  private function _IsGameAlreadyExist($GameID): bool
  {
    try {
      $stmt = $this->_Connection->prepare("SELECT * FROM games WHERE Game_ID = :GameID LIMIT 1");
      $stmt->execute([':GameID' => $GameID]);

      return $stmt->fetch() !== false;
    } catch (PDOException $e) {

      error_log("Error checking if game exists: " . $e->getMessage());
      return false;
    }
  }


  public function __construct()
  {
    // $Connection = new dbconnection;
    // $this->_Connection->getconnection();

    $conn = new clsDataBase("gamevault", "root", "", "localHost");
    $conn->ConnectToDB();
    $this->_Connection = $conn->Connection;

  }

  public function GetAllAvailableWishGames($ListID, $UserID): array
  {

    if (!$this->_IsUserExists($UserID) || !$this->_IsListExist($ListID)) {
      return [];
    }
    try {
      $query = "SELECT games.* 
                  FROM games 
                  JOIN wish_lists_join ON games.Game_ID = wish_lists_join.Game_ID 
                  WHERE wish_lists_join.Wish_List_ID = :listID ";

      $stmt = $this->_Connection->prepare($query);

      $stmt->bindParam(':listID', $ListID, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      error_log("Oops! Something went wrong. Please contact us to solve this issue: " . $e->getMessage());
      return [];
    }
  }


  public function AddGameToWishList($ListID, $GameID): bool
{

    if (!$this->_IsGameAlreadyExist($GameID) || !$this->_IsListExist($ListID)) {
        return false;
    }

    if ($this->_doesGameBelongToWishlist($GameID, $ListID)) {
        echo "\nAlready exists!";
        return false;
    }

 
    try {
        $stmt = $this->_Connection->prepare("INSERT INTO wish_list_join (Game_ID, Wish_List_ID) VALUES (:GameID, :ListID)");
        $stmt->bindParam(':GameID', $GameID, PDO::PARAM_INT);
        $stmt->bindParam(':ListID', $ListID, PDO::PARAM_INT);
        $stmt->execute();
        echo "\nGame successfully added to the wishlist!";
        $stmt =$this->_Connection->prepare("UPDATE games SET Is_Wished = 1 WHERE Game_ID= :GameID");
        $stmt->bindParam(':GameID',$GameID,PDO::PARAM_BOOL);
        $stmt->execute();
        return true;
    } catch (PDOException $err) {
        error_log("Oops! Something went wrong. Please contact us to solve this issue: " . $err->getMessage());
        return false;
    }
}

public function RemoveGameFromWishList($ListID, $GameID): bool
{

    if (!$this->_IsGameAlreadyExist($GameID) || !$this->_IsListExist($ListID)) {
        return false;
    }
 
    if (!$this->_doesGameBelongToWishlist($GameID, $ListID)) {
        echo "\nThe game does not belong to this wishlist!";
        return false;
    }


    try {
        $stmt = $this->_Connection->prepare("DELETE FROM wish_lists_join WHERE Game_ID = :GameID AND Wish_List_ID = :ListID");
        $stmt->bindParam(':GameID', $GameID, PDO::PARAM_INT);
        $stmt->bindParam(':ListID', $ListID, PDO::PARAM_INT);
        $stmt->execute();
        echo "\nGame successfully removed from wishlist!";
        return true;
    } catch (PDOException $err) {
        error_log("Oops! Something went wrong. Please contact us to solve this issue: " . $err->getMessage());

        return false;
    }
}

}
