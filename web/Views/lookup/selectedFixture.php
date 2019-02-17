<?php defined('_CSEXEC') or die; 

if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    $id = '';
}

?>
<input type="hidden" name="fixture" value="<?php echo $id; ?>">
<table class="table">
    <thead>
        <tr>
            <th class="col-4">Catwalk</th>
            <th class="col-4">Number</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if($id != "") {
            echo $this->controller->selectedFixture($id); 
        }
        ?>
    </tbody>
</table>
