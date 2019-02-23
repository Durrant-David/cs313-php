<?php defined('_CSEXEC') or die; 

$id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$category = isset($_POST['category']) ? htmlspecialchars($_POST['category']) : '';
$location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '';
$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : '';
$image = isset($_POST['image']) ? htmlspecialchars($_POST['image']) : '';
$description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
$edit = isset($_POST['edit']) ? htmlspecialchars($_POST['edit']) : '';
$submit = isset($_POST['submit']) ? htmlspecialchars($_POST['submit']) : '';

$values = array("id"=>$id, "name"=>$name, "category"=>$category, "location"=>$location, "status"=>$status,
                "image"=>$image, "description"=>$description);

if($edit == true){
    $save = "update" . ucfirst($type);
} else {
    $save = "insert" . ucfirst($type);
}

if($submit == "Save") {
    if ($edit == false) {
        $id = $this->model->$save($values);
    } else {
        $this->model->$save($values);
    }
    ?>
    <script>
        window.location.href = '<?php echo $type . "Edit?id=$id"; ?>';
    </script>
    <?php
} else {
    $this->model->$save($values);
    ?>
    <script>
        window.location.href = 'categories?category=<?php echo $category; ?>';
    </script>
    <?php
}
