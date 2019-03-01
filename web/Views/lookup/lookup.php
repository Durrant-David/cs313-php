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
        }

        public function filters()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/filters.php';
        }

        public function index()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/index.php';
        }

        public function edit()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/edit.php';
        }

        public function fixture()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/selectedFixture.php';
        }

        public function save()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/save.php';
        }

        public function status()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/status.php';
        }

        public function api()
        {
            include_once $GLOBALS['root'] . '/Views/lookup/json.php';
        }
    }
?>