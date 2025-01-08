<?php
  require_once "clsInputValidate.php";
  require_once "clsAdmin.php";
  if($_SERVER["REQUEST_METHOD"]== "POST")
  {
    $GameName=clsInputValidate::Test_Input($_POST["game-name"]);
    $PoserURL=clsInputValidate::Test_Input($_POST["poster"]);
    $GameCategory=clsInputValidate::Test_Input($_POST["game-category"]);
    $ReleaseDate=clsInputValidate::Test_Input($_POST["release-date"]);
    $admin=new clsAdmin();
    if(
    $admin->addNewGame($GameName,$PoserURL,$GameCategory,$ReleaseDate))
    {
      echo "<p>saved successfully</p>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add-new-Game</title>
  <link rel="stylesheet" href="add-new-game.css">
</head>

<body>

    <form action="add-new-game.php" method="POST">
      <h2>add new game</h2>
      <div>
        <label for="game-name"><span>Game Name</span></label>
        <input type="text" name="game-name" id="game-name" value="" required>
      </div>
      <div>
        <label for="poster"><span>poster path</span></label>
        <input type="text" name="poster" id="poster" value="" required>
      </div>
      <div>
        <label for="game-category"><span>game category</span></label>
        <input type="text" name="game-category" id="game-category" value="">
      </div>
      <div>
        <label for="Release-date"><span>release date</span></label>
        <input type="date" name="release-date" id="release-date">
      </div>
      <button type="submit" name="savechanges">save</button>
    </form>


</body>

</html>