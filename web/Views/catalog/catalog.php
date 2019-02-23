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

        public function categoryEdit()
        {
            $edit = true;
            include_once $GLOBALS['root'] . '/Views/catalog/category.php';
        }

        public function categoryNew()
        {
            $edit = false;
            include_once $GLOBALS['root'] . '/Views/catalog/category.php';
        }

        public function itemEdit()
        {
            $edit = true;
            include_once $GLOBALS['root'] . '/Views/catalog/item.php';
        }

        public function itemNew()
        {
            $edit = false;
            include_once $GLOBALS['root'] . '/Views/catalog/item.php';
        }

        public function save()
        {
            include_once $GLOBALS['root'] . '/Views/catalog/save.php';
        }
    }
?>