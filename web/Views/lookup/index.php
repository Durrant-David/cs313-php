<?php defined('_CSEXEC') or die; 
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
        .floatingBox {
            position: fixed;
            width: 180px;
            right: 0px;
            transition: right 2s;
        }

        .boxHidden {
            right: -140px;
        }

        i {
            font-size: 20px;
            padding: 10px
        }

    </style>
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
    ?>

    <script>
        function hideBox() {
            document.getElementById("floatingBox").classList.toggle("boxHidden");

            var icon = document.getElementById("boxBtn").classList.contains("glyphicon-chevron-right");
            if (icon) {
                document.getElementById("boxBtn").classList.add("glyphicon-chevron-left");
                document.getElementById("boxBtn").classList.remove("glyphicon-chevron-right");
            } else {
                document.getElementById("boxBtn").classList.add("glyphicon-chevron-right");
                document.getElementById("boxBtn").classList.remove("glyphicon-chevron-left");
            }

        }

    </script>
    <div id="floatingBox" class="floatingBox">
        <table>
            <tr>
                <td>
                    <i id="boxBtn" onclick="hideBox()" class="glyphicon glyphicon-chevron-right"></i>
                </td>
                <td class="">
                    <?php include_once $GLOBALS['root'] . '/Views/lookup/filters.php'; ?>
                </td>
            </tr>
        </table>
    </div>
    <div id="list"></div>
    <script>
        function toggleLight(id, status) {
            if (status == "Working") {
                status = "Burn Out";
            } else {
                status = "Working";
            }
            toggleStatus(id, status);
        }
        
        function toggleTag(id, status) {
            if (status == "Red Tag") {
                status = "Working";
            } else {
                status = "Red Tag";
            }
            toggleStatus(id, status);
        }
        
        function toggleStatus(id, itemStatus) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("updateStatus").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", "status?id=" + id + "&status=" + itemStatus, true);
            xhttp.send();
            list();
        }

        window.onload = list();
        function list() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("list").innerHTML =
                        this.responseText;
                }
            };
            xhttp.open("GET", "list", true);
            xhttp.send();
        }

    </script>
</body>

</html>
