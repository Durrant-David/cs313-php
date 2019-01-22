<html>
    <body>
        <?php 
        $major = array(
            'cs' => 'Computer Science',
            'wdd' => 'Web Design and Development',
            'cit' => 'Computer information Technology',
            'ce' => 'Computer Engineering');
        include "map/dictionary/index.php"; 
        ?>
        Student Name: <?php echo $_POST["name"]; ?><br>
        Student Email: <?php echo $_POST["email"]; ?><br>
        Student Major: <?php echo $major[$_POST["major"]]; ?><br>
        Student Comments: <?php echo $_POST["comments"]; ?><br>
        Student Visited continents:<br> 
        <?php foreach ($_POST["continents"] as $selected) {
            echo $map[$selected] . "<br>"; 
        } ?>
    </body>
</html>