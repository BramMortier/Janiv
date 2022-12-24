<?php 

class GameModel extends Model 
{
    public $query;

    public $gameName;
    public $gameNameErr;

    public $losingScore;
    public $losingScoreErr;

    public $players;
    public $playersErr;

    public $round;
    public $newRoundScores;
    public $newRoundScoresErr;

    public function getAllGames()
    {
        $db = $this->db_connect();
        $sql = 
        "SELECT g.id as gameId, g.name as gameName, GROUP_CONCAT(gp.name) as gamePlayers
        FROM janiv.games as g
        INNER JOIN janiv.game_players as gp
            ON g.id = gp.game_id
        WHERE g.user_id = :id
        GROUP BY g.name";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->execute();
            $games = $stmt->fetchAll(PDO::FETCH_OBJ);
            unset($stmt);
        }

        return $games;
    }

    public function getGamesByQuery()
    {
        $db = $this->db_connect();

        $sql =
        "SELECT g.id as gameId, g.name as gameName, GROUP_CONCAT(gp.name) as gamePlayers
        FROM janiv.games as g
        INNER JOIN janiv.game_players as gp
            ON g.id = gp.game_id
        WHERE user_id = :id AND g.name LIKE CONCAT('%', :query ,'%')
        GROUP BY g.name";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue(":query", $this->query, PDO::PARAM_STR);
            $stmt->execute();
            $games = $stmt->fetchAll(PDO::FETCH_OBJ);
            unset($stmt);
        }

        return $games;
    }

    public function getGameScores($gameId)
    {
        $db = $this->db_connect();

        $sql =
        "SELECT gp.id as playerId, gp.name as playerName, GROUP_CONCAT(gps.score) as playerScores
        FROM janiv.games as g
        INNER JOIN janiv.game_players as gp
            ON g.id = gp.game_id
        LEFT OUTER JOIN janiv.game_player_scores as gps
            ON gp.id = gps.player_id
        WHERE g.user_id = :userId AND g.id = :gameId
        GROUP BY gp.name";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":userId", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue(":gameId", $gameId, PDO::PARAM_STR);

            $stmt->execute();
            $gameScores = $stmt->fetchAll(PDO::FETCH_OBJ);
            unset($stmt);
        }

        return $gameScores;
    }

    public function getGameRound($gameId)
    {
        $db = $this->db_connect();

        $sql = 
        "SELECT MAX(gps.round) as round
        FROM janiv.game_players as gp
        INNER JOIN janiv.game_player_scores as gps
            ON gp.id = gps.player_id
        WHERE gp.game_id = :id";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":id", $gameId, PDO::PARAM_STR);
            $stmt->execute();
            $round = $stmt->fetch(PDO::FETCH_OBJ);
            unset($stmt);
        }

        return $round;
    }


    public function createNewGame()
    {
        $db = $this->db_connect();

        $sql = 
        "INSERT INTO janiv.games 
            (user_id, name, losing_score)
        VALUES 
            (:id, :name, :score)";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":id", $_SESSION["id"], PDO::PARAM_STR);
            $stmt->bindValue(":name", $this->gameName, PDO::PARAM_STR);
            $stmt->bindValue(":score", $this->losingScore, PDO::PARAM_STR);

            $stmt->execute();
            unset($stmt);
        }

        foreach($this->players as $index => $player)
        {
            $this->addNewPlayer($db->lastInsertId(), $player);
        }

        header("location: /dashboard");
    }

    public function addNewPlayer($gameId, $playerName)
    {
        $db = $this->db_connect();

        $sql = 
        "INSERT INTO janiv.game_players 
            (game_id, name)
        VALUES 
            (:id, :name)";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":id", $gameId, PDO::PARAM_STR);
            $stmt->bindValue(":name", $playerName, PDO::PARAM_STR);

            $stmt->execute();
            unset($stmt);
        }
    }

    public function deleteGame($gameId)
    {
        $db = $this->db_connect();

        $sql = "DELETE FROM janiv.games WHERE id = :id";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":id", $gameId, PDO::PARAM_STR);
            $stmt->execute();
            unset($stmt); 
        }

        header("location: /dashboard");
    }

    public function AddNewRound($gameId)
    {
        $db = $this->db_connect();

        foreach($this->newRoundScores as $key => $score)
        {
            $sql = 
            "INSERT INTO janiv.game_player_scores 
                (player_id, score, round) 
            VALUES
                (:id, :score, :round)";

            if($stmt = $db->prepare($sql))
            {
                $stmt->bindValue(":id", $key, PDO::PARAM_STR);
                $stmt->bindValue(":score", $score, PDO::PARAM_STR);
                $stmt->bindValue(":round", $this->round, PDO::PARAM_STR);

                $stmt->execute();
                unset($stmt);
            }
        }

        header("location: /game/scoreboard/$gameId");
    }

    public function deleteRound($gameId)
    {
        $db = $this->db_connect();
        $round = $this->getGameRound($gameId)->round;

        $sql = "DELETE FROM janiv.game_player_scores WHERE round = :round";

        if($stmt = $db->prepare($sql))
        {
            $stmt->bindValue(":round", $round, PDO::PARAM_STR);
            $stmt->execute();
            unset($stmt);
        }

        header("location: /game/scoreboard/$gameId");
    }
}