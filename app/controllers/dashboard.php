<?php

Class Dashboard extends Controller
{
    public function index()
    {
        $this->checkAuth();

        $gameModel = $this->loadModel("gameModel");
        $data["games"] = $gameModel->getAllGames();

        $data["page_title"] = "Dashboard";
        $this->view("dashboard", $data);
    }

    public function info()
    {
        $this->checkAuth();

        $data["page_title"] = "Game info";
        $this->view("gameInfo", $data);
    }
}