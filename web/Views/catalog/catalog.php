<?php
defined('_CSEXEC') or die;
    class CatalogView
    {

        private $model;

        private $controller;


        function __construct($controller, $model)
        {
            $this->controller = $controller;

            $this->model = $model;
        }

        public function categories()
        {
            include_once $GLOBALS['root'] . '/Views/catalog/categories.php';
        }
    }
?>