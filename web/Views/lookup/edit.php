<?php defined('_CSEXEC') or die; 

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
    <style>
        .listIcon {
        color: black;
        font-size: 26px;
        text-shadow:2px 2px 4px #000000;
        margin: 4px;
    }
    
    .overflow {
      height: 500px;
      overflow: auto;
    }
    
    .table-select tr:hover {
        background-color: aqua;
    cursor: pointer;
    }
</style>
</head>

<body>
    <?php
        require_once $GLOBALS['root'] .'/Models/mainMenu.php';
        require_once $GLOBALS['root'] .'/Controllers/mainMenu.php';
        require_once $GLOBALS['root'] .'/Views/mainMenu.php';
        
        $menuController = new MainMenuController( new MainMenuModel );
        $menuObj = new MainMenuView( $menuController, new MainMenuModel);
        
        print $menuObj->navbar();
    ?>

    <div class="container">
        <h2>Edit Lookup Item</h2>
        <form action="save?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="type">Type:</label>
                <select id="type" class="form-control" name="type">
                    <?php echo $this->controller->displayDropDown("Type"); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="level">Level:</label>
                <select id="level" class="form-control" name="level">
                    <?php echo $this->controller->displayDropDown("Level"); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="catwalk">Catwalk:</label>
                <select id="catwalk" class="form-control" name="catwalk">
                    <?php echo $this->controller->displayDropDown("Catwalk"); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="chair">Chair:</label>
                <select id="chair" class="form-control" name="chair">
                    <?php echo $this->controller->displayDropDown("Chair"); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="position">Position:</label>
                <select id="position" class="form-control" name="position">
                    <?php echo $this->controller->displayDropDown("Position"); ?>
                </select>
            </div>
<!--   TODO setup to update status table
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" class="form-control" name="status">
                    <?php //echo $this->controller->displayStatusList("Status"); ?>
                </select>
            </div>
-->
            <div id="fixture">
            </div>
            <div class="pull-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Select fixture</button>

                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Select fixture</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-4"></th>
                                            <th class="col-4">Catwalk</th>
                                            <th class="col-4">Number</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="overflow">
                                    <table class="table table-select">
                                        <tbody>
                                            <?php echo $this->controller->selectFixture(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="getSelected()">Select</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <input type="submit" class="btn btn-success" name="submit" value="Save">
        <input type="submit" class="btn btn-primary" name="submit" value="Save & Close">
        <a href="index" class="btn btn-danger">Close</a>
        </form>
        <div id="save"></div>
    </div>
    <script>
        <?php echo $this->controller->loadItemValues($id); ?>
        
        function loadFixture(fix = 0) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("fixture").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", "fixture?id=" + fix, true);
            xhttp.send();
        }

        function SelectElement(id, valueSel) {
            if(valueSel == '') {
                const valueSel = id.charAt(0).toUpperCase() + id.slice(1)
            }
            var element = document.getElementById(id);
            element.value = valueSel;
        }

        function getSelected() {
            var fix_id = document.querySelector('input[name="fixtures"]:checked').id;
            loadFixture(fix_id);
        }

        function setSelected(id) {
            document.getElementById(id).checked = true;
        }

    </script>
</body>

</html>
