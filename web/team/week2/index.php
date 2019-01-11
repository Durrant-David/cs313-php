<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="script.js"></script>
        <title>Week 2 - Team</title>
    </head>
    <body>        
        <div class="container">
            <div class="row">
                <div class="col-sm-4 well">
                    <div id="color" class="hover">change my color</div>
                    <div>
                        Text color: <input type="text" id="txtColor"><br>
                        <button id="btnColor">Change color</button>
                    </div>
                </div>
                <div class="col-sm-4 well">
                    <div class="hover">Alert</div>
                    <div>
                        <button onclick="myAlert();">Click Me</button>
                    </div>
                </div>
                <div class="col-sm-4 well">
                    <div class="hover tHide">hide me</div>
                    <div>
                        <button id="btnHide">Toggle div</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>