<?php

    require_once 'dbconn.php';

    class game{
        private $game_ID;
        private $game_name;
        private $game_poster;
        private $game_category;
        private $game_releasedate;

        public function __construct($game_name,$game_category,$game_poster,$game_releasedate)
        {
                $this->game_name = $game_name;
                $this->game_category = $game_category;
                $this->game_poster = $game_poster;
                $this->game_releasedate = $game_releasedate;
        }

        public static function fetchallgames(){
            $dbconnection = dbconnection::Getinstanse();
            $connection = $dbconnection->getconnection();

            $stmt = $connection->prepare("SELECT * FROM games");
            $stmt->execute();
            return  $stmt->fetchALL(PDO::FETCH_ASSOC);
        }
        public static function fetchGamebyid($game_ID){
            $dbconnection = dbconnection::Getinstanse();
            $connection = $dbconnection->getconnection();

            $stmt = $connection->prepare("SELECT * FROM games WHERE Game_ID = :id");
            $stmt->bindParam(':id',$game_ID);
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_ASSOC);
        } 

        public function addNewGame($GameName, $PosterURL, $Category, $ReleaseDate)
        {
            $dbconnection = dbconnection::Getinstanse();
            $connection = $dbconnection->getconnection();

            $stmt = $connection->prepare("INSERT INTO games (Game_Name, Poster, Game_Category, Relese_Date) 
                                                   VALUES (:GameName, :PosterURL, :Category, :ReleaseDate)");
      
            $stmt->execute([
              ':GameName' => $GameName,
              ':PosterURL' => $PosterURL,
              ':Category' => $Category,
              ':ReleaseDate' => $ReleaseDate
            ]);
      
        }

        public static function addscreen($Game_ID,$Screen_URL){
            $dbconnection = dbconnection::Getinstanse();
            $connection = $dbconnection->getconnection();
            $stmt = $connection->prepare("INSERT INTO Screen_Shots(Game_ID, Screen_Url) VALUES(:game_id,:screen_url)");
            $stmt->bindParam(':game_id',$Game_ID);
            $stmt->bindParam(':screen_url',$Screen_URL);
            $stmt->execute(); 
            header('location: dashboard.php');
            exit;
        }

        public static function fetchgamemessages($Game_ID){
            $dbconnection = dbconnection::Getinstanse();
            $connection = $dbconnection->getconnection();
            $stmt = $connection->prepare("SELECT * FROM chat_messages WHERE Game_ID =:game_id");
            $stmt->bindParam(':game_id',$Game_ID);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public static function Insertgamemessage($Game_ID,$User_ID,$content,$Nick_Name,$user_profile){
            $dbconnection = dbconnection::Getinstanse();
            $connection = $dbconnection->getconnection();
            $stmt = $connection->prepare("INSERT INTO chat_messages(Game_ID,User_ID,Message_Content,Nick_Name,user_profile) values(:gameid,:userid,:content,:nickname,:user_profile) ");
            $stmt->bindParam(':gameid',$Game_ID);
            $stmt->bindParam(':userid',$User_ID);
            $stmt->bindParam(':content',$content);
            $stmt->bindParam(':nickname',$Nick_Name);
            $stmt->bindParam(':user_profile',$user_profile);
            $stmt->execute();   
        }

        public static function fetchgamescreens($Game_ID){
            $dbconnection = dbconnection::Getinstanse();
            $connection = $dbconnection->getconnection();
            $stmt = $connection->prepare("SELECT * FROM  Screen_Shots WHERE Game_ID =:game_id LIMIT 6");
            $stmt->bindParam(':game_id',$Game_ID);
            $stmt->execute(); 
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        }
    }
?>