<?php

Class Game extends Controller
{
    public function index()
    {
        $this->checkAuth();

        $data["page_title"] = "Dashboard";
        $this->view("dashboard", $data);
    }

    public function create()
    {
        $this->checkAuth();
        $gameModel = $this->loadModel("gameModel");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(empty(trim($_POST["gameName"]))){
                $gameModel->gameNameErr = "Please choose a name.";
            } elseif(!preg_match('/^[A-Za-z0-9 _~\-!@#\$%\^&\*\(\)]+$/', trim($_POST["gameName"]))) {
                $gameModel->gameNameErr = "No special chars allowed";
            } else {
                $gameModel->gameName = trim($_POST["gameName"]);
            }
            
            if(empty(trim($_POST["losingScore"]))){
                $gameModel->losingScoreErr = "Set a losing score.";
            } elseif(intval($_POST["gameName"])) {
                $gameModel->losingScoreErr = "Score must be a number";
            } else {
                $gameModel->losingScore = trim($_POST["losingScore"]);
            }
            
            if(empty($_POST["players"][0])){
                $gameModel->playersErr = "Player sheet incomplete";
            } else {
                $gameModel->players = $_POST["players"];
            }

            if(
                empty($gameModel->gameNameErr) &&
                empty($gameModel->losingScoreErr) &&
                empty($gameModel->playersErr) 
            ) {
                $gameModel->createNewGame();
            }
        }

        $data["createdGame"] = (object) [
            "gameName" => $gameModel->gameName ?? "",
            "gameNameErr" => $gameModel->gameNameErr ?? "",

            "losingScore" => $gameModel->losingScore ?? "",
            "losingScoreErr" => $gameModel->losingScoreErr ?? ""
            , 
            "players" => $gameModel->players ?? "",
            "playersErr" => $gameModel->playersErr
        ];

        $data["page_title"] = "Create game";
        $this->view("createGame", $data);
    }

    public function delete($id)
    {
        $this->checkAuth();
        $gameModel = $this->loadModel("gameModel");
        $gameModel->deleteGame($id);
    }

    public function load()
    {
        $this->checkAuth();
        $gameModel = $this->loadModel("gameModel");
        $data["games"] = $gameModel->getAllGames();

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(empty(trim($_POST["query"]))){
                $data["games"] = $gameModel->getAllGames();
            } else {
                $gameModel->query = trim($_POST["query"]);
                $data["games"] = $gameModel->getGamesByQuery();
            }
        }
        
        $data["query"] = $gameModel->query;
        $data["page_title"] = "Load game";
        $this->view("loadGame", $data);
    }

    public function scoreboard($id)
    {
        $this->checkAuth();
        $gameModel = $this->loadModel("gameModel");

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            foreach($_POST["scores"] as $key => $score)
            {
                if(empty(trim($score))){
                    $gameModel->newRoundScoresErr = "Fields can't be empty";
                }
            }

            $gameModel->round = $_POST["round"];

            if(empty($gameModel->newRoundScoresErr))
            {
                $gameModel->newRoundScores = $_POST["scores"];
                $gameModel->addNewRound($id);
            }
        }

        $data["gameInfo"] = $gameModel->getGameRound($id);
        $data["gameScores"] = $gameModel->getGameScores($id);
        $data["gameId"] = $id;
    
        $data["page_title"] = "Scoreboard";
        $this->view("scoreboard", $data);
    }

    public function deleteRound($id)
    {
        $this->checkAuth();
        $gameModel = $this->loadModel("gameModel");
        $gameModel->deleteRound($id);
    }
}