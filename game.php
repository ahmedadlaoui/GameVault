<?php

    require_once 'dbconn.php';

    class game{

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
    }

?>