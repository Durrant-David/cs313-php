<html>
    <head>
        <title>Team - week 03</title>
    </head>
    <body>
        <?php 
        $major = array(
            'cs' => 'Computer Science',
            'wdd' => 'Web Design and Development',
            'cit' => 'Computer information Technology',
            'ce' => 'Computer Engineering');
        include "map/dictionary/index.php"; ?>
        <form action="student.php" method="post">
            Name:
            <input type="text" name="name">
            <br><br>
            Email:
            <input type="email" name="email">
            <br><br>
            Major:<br>
            <?php 
            foreach($major as $key => $study) {
                echo '<input type="radio" name="major" value="' . $key . '">' . $study . '<br>';
            }
            ?>
            <br>
            Comments:<br>
            <textarea name="comments" rows"10" cols="30"></textarea>
            <br><br>
            Continents visited:<br>
            <?php 
            foreach($map as $key => $place) {
                echo '<input type="checkbox" name="continents[]" value="' . $key . '">' . $place . '<br>';
            }
            ?>
            <br>
            <input type="submit">
        </form>
    </body>             
</html>