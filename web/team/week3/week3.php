<html>
    <body>
        <?php 
            $major = Array("cs" => "Computer Science",
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
        ?>
        <form action="formAction.php" method="post">
            Name: <input name="name" type="text"><br>
            Email: <input name="email" type="email"><br>
            Major: <?php foreach($major as $key => $item){
                        echo "<input name='major' type='radio' value='$key'>$item<br>";
                    } ?>
            Comments: <textarea name="comments"></textarea><br>
            Continents: <?php foreach ($continents as $key => $item) {
                            echo "<input name='continents[]' type='checkbox' value='$key'>$item<br>";
                        } ?>
            <input type="submit">
        </form>
    </body>
</html>