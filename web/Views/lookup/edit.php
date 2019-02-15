<?php defined('_CSEXEC') or die; 

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
$level = isset($_POST['level']) ? htmlspecialchars($_POST['level']) : '';
$catwalk = isset($_POST['catwalk']) ? htmlspecialchars($_POST['catwalk']) : '';
$chair = isset($_POST['chair']) ? htmlspecialchars($_POST['chair']) : '';
$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : '';
$fixture = isset($_POST['fixture']) ? htmlspecialchars($_POST['fixture']) : '';

?>
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
</style>
<div class="container">
    <h2>Edit Lookup Item</h2>
    <form action="" method="post">
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
            <label for="position">Fixture:</label>
            <select id="position" class="form-control" name="position">
                <?php echo $this->controller->displayDropDown("Position"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" class="form-control" name="status">
                <?php echo $this->controller->displayStatusList("Status"); ?>
            </select>
        </div>
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
                <table class="table table-striped">
                    <tbody>
                        <?php echo $this->controller->selectFixture(); ?>
                    </tbody>
                </table>
            </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
<script>
<?php echo $this->controller->loadItemValues($id); ?>

function SelectElement(id, valueToSelect)
{    
    var element = document.getElementById(id);
    element.value = valueToSelect;
}
</script>