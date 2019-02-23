<?php defined('_CSEXEC') or die; 
$parent = isset($_GET['parent']) ? htmlspecialchars($_GET['parent']) : '';
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php echo ucfirst($GLOBALS['requestedController']); ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <div id="updateStatus"></div>
    <?php
        require_once $GLOBALS['root'] .'/Models/mainMenu.php';
        require_once $GLOBALS['root'] .'/Controllers/mainMenu.php';
        require_once $GLOBALS['root'] .'/Views/mainMenu.php';
        
        $menuController = new MainMenuController( new MainMenuModel );
        $menuObj = new MainMenuView( $menuController, new MainMenuModel);
        
        print $menuObj->navbar();
        if ($id != "") {
            $item = $this->model->getCategory($id);
        }
    ?>
    
    <div class="container">
        <h2><?php if ($edit) { echo "Edit"; } else { echo "New"; } ?> Item</h2>
        <form action="save" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php if ($id != "") { echo $item['name']; } ?>">
            </div>
            <div class="form-group">
                <label for="category">Parent Category:</label>
                <select id="category" class="form-control" name="category">
                    <?php echo $this->controller->displayCategoryList(); ?>
                </select>
            </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="type" value="category">
        <input type="hidden" name="edit" value="<?php echo $edit; ?>">
        <input type="submit" class="btn btn-success" name="submit" value="Save">
        <input type="submit" class="btn btn-primary" name="submit" value="Save & Close">
        <a href="categories?category=<?php 
                      if ($id != "") { 
                          echo $item['parent_category_id']; 
                      } else { 
                          echo $parent; 
                      } ?>" class="btn btn-danger">Close</a>
        </form>
        <div id="save"></div>
    </div>
    <script>
        SelectElement("category", <?php 
                      if ($id != "") { 
                          echo $item['parent_category_id']; 
                      } else { 
                          echo $parent; 
                      } ?>);

        function SelectElement(id, valueSel) {
            if(valueSel == '') {
                const valueSel = id.charAt(0).toUpperCase() + id.slice(1)
            }
            var element = document.getElementById(id);
            element.value = valueSel;
        }


    </script>
</body>

</html>