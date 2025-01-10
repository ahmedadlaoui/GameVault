<?php
require_once 'dbconn.php';
class User
{
  private $nickname;
  private $Email;
  private $profilpic;
  private $User_ID;

  public function __construct($nickname, $Email, $profilpic, $User_ID)
  {
    $this->nickname =  $nickname;
    $this->Email = $Email;
    $this->profilpic = $profilpic;
    $this->User_ID = $User_ID;
  }

  public static function fetchuser_infos()
  {

    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();

    $stmt = $connection->prepare("SELECT * FROM users WHERE User_ID = :user_id ");
    $stmt->bindParam(':user_id', $_SESSION['user_ID']);
    $stmt->execute();
    return  $stmt->Fetch(PDO::FETCH_ASSOC);
  }

  public static function edit_uuserinfos()
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();
    $newhashedpass = base64_encode($_POST['new-password']);

    $stmt = $connection->prepare("UPDATE users SET Nick_Name = :currentuser,Email = :currentemail, Password = :currentpassword, Profile_Pic = :newpwic WHERE Nick_Name =:curr  ");
    $stmt->bindParam(':curr',  $_SESSION['Nickname']);
    $stmt->bindParam(':currentuser', $_POST['name']);
    $stmt->bindParam(':currentemail', $_POST['email']);
    $stmt->bindParam(':newpwic',$_POST['new-profile_pic']);
    $stmt->bindParam(':currentpassword', $newhashedpass);
    $stmt->execute();

    $_SESSION['Nickname'] = $_POST['name'];
    $_SESSION['Email'] = $_POST['email'];
    $_SESSION['Profile_Pic'] =$_POST['new-profile_pic'];
  }

  public static function fetchallusers()
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();

    $stmt = $connection->prepare("SELECT * FROM users");
    $stmt->execute();
    return  $stmt->FetchAll(PDO::FETCH_ASSOC);
  }
  public static function fetchlibrarygames()
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();



    $stmt = $connection->prepare("SELECT * FROM Libraries WHERE User_ID = :userid");
    $stmt->bindParam('userid', $_SESSION['user_ID']);
    $stmt->execute();
    $currentlib = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $connection->prepare("SELECT * FROM library_join WHERE Library_ID = :libid");
    $stmt->bindParam(':libid', $currentlib['Library_ID']);
    $stmt->execute();
    $librarygamesID = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($librarygamesID){
        $gameIDs = array_column($librarygamesID, 'Game_ID');
        $placeholders = implode(',', array_fill(0, count($gameIDs), '?'));
        $stmt = $connection->prepare("SELECT * FROM Games WHERE Game_ID IN ($placeholders)");
        $stmt->execute($gameIDs);
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  }

  public static function BanUser($User_ID): bool
  {
    $dbconnection = dbconnection::Getinstanse();
    $connection = $dbconnection->getconnection();

    $stmt = $connection->prepare("UPDATE users SET Banned=1 WHERE User_ID = :id");
    $stmt->execute([':id' => $User_ID]);
    return true;
  }
}

$library_games = User::fetchlibrarygames();
$user_infos = User::fetchuser_infos();
$users = User::fetchallusers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['savechanges'])) {
  user::edit_uuserinfos();
}

if (!empty($_SESSION['user_ID']) && isset($_GET['User_ID'])) {
  User::BanUser($_GET['User_ID']);
}


?>