<html>
    <body>
        <?php 
        $name = $_POST['name'];
        $email = $_POST['email'];
        $major = $_POST['major'];
        $comments = $_POST['comments'];
            $majorValues = Array("cs" => "Computer Science",
                          "wdd" => "Web Design and Development",
                          "cit" => "Computer information Technology",
                          "ce" => "Computer Engineering");
        
            $continents = Array("na" => "North America",
                          "sa" => "South America",
                          "eu" => "Europe",
                          "as" => "Asia",
                          "au" => "Australia",
                          "af" => "Africa",
                          "an" => "Antarctica");
        
        echo "Name: $name
            <br>Email: <a href='mailto:$email'> $email</a>
            <br>Major: $majorValues[$major]
            <br>Comments: $comments
            <br>Continents:<br>";
        foreach ($_POST['continents'] as $item) {
            echo "$continents[$item]<br>";
        }
        ?>
    </body>
</html>