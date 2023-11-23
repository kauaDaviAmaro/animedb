<?php

class Aplicacao {
    public Routeador $routeador;
    public View $view;
    public Database $db;
    public Session $session;
    public static Aplicacao $app;

    public function __construct() {
        $this->routeador = new Routeador();
        $this->view = new View();
        $this->db = new Database();
        $this->session = new Session();
        self::$app = $this;
    }

    public function run() {
       $this->routeador->execute();
    }
}