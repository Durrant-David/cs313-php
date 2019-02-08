<?php
defined('_CSEXEC') or die;
    class LookupView
    {

        private $model;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
        }

        public function list()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/list.php';
            //return $this->controller->sayWelcome();
        }

        public function filters()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/filters.php';
            //return $this->controller->sayWelcome();
        }

        public function index()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/index.php';
        }
    }
?>