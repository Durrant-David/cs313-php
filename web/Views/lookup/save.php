<?php defined('_CSEXEC') or die; 

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
$level = isset($_POST['level']) ? htmlspecialchars($_POST['level']) : '';
$catwalk = isset($_POST['catwalk']) ? htmlspecialchars($_POST['catwalk']) : '';
$chair = isset($_POST['chair']) ? htmlspecialchars($_POST['chair']) : '';
$position = isset($_POST['position']) ? htmlspecialchars($_POST['position']) : '';
$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : '';
$fixture = isset($_POST['fixture']) ? htmlspecialchars($_POST['fixture']) : '';
$submit = isset($_POST['submit']) ? htmlspecialchars($_POST['submit']) : '';

$values = array("id"=>$id, "type"=>$type, "level"=>$level, "catwalk"=>$catwalk,
                "chair"=>$chair, "position"=>$position, "status"=>$status,
                "fixture"=>$fixture);

if($submit == "Save") {
    $this->controller->updateItem($values);
    ?>
    <script>
        window.location.href = 'edit?id=<?php echo $id; ?>';
    </script>
    <?php
} else {
    $this->controller->updateItem($values);
    ?>
    <script>
        window.location.href = 'index';
    </script>
    <?php
}
