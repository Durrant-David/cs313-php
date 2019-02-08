<?php
    define( '_CSEXEC', 1 );
    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

    //get root directory
    $root = $_SERVER['DOCUMENT_ROOT'];
    //connect to database
    require_once "$root/Models/connection.php";

    if ($url == '/')
    {

        // This is the home page
        // Initiate the home controller
        // and render the home view

        //include main menu
        //require_once $root . '/Models/index_model.php';
        //require_once $root . '/Controllers/index_controller.php';
        require_once $root . '/Views/index.php'; 

        //$indexModel = New IndexModel();
        //$indexController = New IndexController($indexModel);
        //$indexView = New IndexView($indexController, $indexModel);

        //print $indexView->index();


    }else{


        // This is not home page
        // Initiate the appropriate controller
        // and render the required view

        //The first element should be a controller
        $requestedController = $url[0]; 

        // If a second part is added in the URI, 
        // it should be a method
        $requestedAction = isset($url[1])? $url[1] :'';

        // The remain parts are considered as 
        // arguments of the method
        $requestedParams = array_slice($url, 2); 

        // Check if controller exists. NB: 
        // You have to do that for the model and the view too
        $ctrlPath = $root .'/Controllers/'.$requestedController.'.php';

        // Base structure of website
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title><?php echo ucfirst($requestedController); ?></title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>

        <body>
        <?php
        require_once $root .'/Models/mainMenu.php';
        require_once $root .'/Controllers/mainMenu.php';
        require_once $root .'/Views/mainMenu.php';
        
        $menuController = new MainMenuController( new MainMenuModel );
        $menuObj = new MainMenuView( $menuController, new MainMenuModel);
        
        print $menuObj->navbar();

        if (file_exists($ctrlPath))
        {

            require_once "$root/Models/$requestedController.php";
            require_once "$root/Controllers/$requestedController.php";
            require_once "$root/Views/$requestedController/$requestedController.php";

            $modelName      = ucfirst($requestedController).'Model';
            $controllerName = ucfirst($requestedController).'Controller';
            $viewName       = ucfirst($requestedController).'View';

            $controllerObj  = new $controllerName( new $modelName );
            $viewObj        = new $viewName( $controllerObj, new $modelName );


            // If there is a method - Second parameter
            if ($requestedAction != '')
            {
                // then we call the method via the view
                // dynamic call of the view
                print $viewObj->$requestedAction($requestedParams);
            }

        }else{

            header('HTTP/1.1 404 Not Found');
            die('404 - The file - '.$ctrlPath.' - not found');
            //require the 404 controller and initiate it
            //Display its view
        }
        ?>
        </body>
        </html>
        <?php
    }
?>