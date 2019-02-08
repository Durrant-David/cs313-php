<?php defined('_CSEXEC') or die; ?>
<?php $this->controller->selectedFuncJS(); ?>

<script>
    function clearParams() {
        var x = window.location.href.split("?")[0];
        window.location.href = x;
    }
</script>
<div id="test"></div>
<form method="get">
    <div class="form-group">
        <select class="form-control" id="typeSelect" name="type">
            <?php echo $this->controller->displayDropDown("Type"); ?>
        </select>
        <?php $this->controller->setSelectedJS("type"); ?>
        <select class="form-control" id="levelSelect" name="level">
            <?php echo $this->controller->displayDropDown("Level"); ?>
        </select>
        <?php $this->controller->setSelectedJS("level"); ?>
        <select class="form-control" id="catwalkSelect" name="catwalk">
            <?php echo $this->controller->displayDropDown("Catwalk"); ?>
        </select>
        <?php $this->controller->setSelectedJS("catwalk"); ?>
        <select class="form-control" id="chairSelect" name="chair">
            <?php echo $this->controller->displayDropDown("Chair"); ?>
        </select>
        <?php $this->controller->setSelectedJS("chair"); ?>
        <select class="form-control" id="positionSelect" name="position">
            <?php echo $this->controller->displayDropDown("Position"); ?>
        </select>
        <?php $this->controller->setSelectedJS("position"); ?>
        <select class="form-control" id="statusSelect" name="status">
            <?php echo $this->controller->displayStatusList("Status"); ?>
        </select>
        <?php $this->controller->setSelectedJS("status"); ?>
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary btn-md">Submit</button>
                <a onclick="clearParams();" class="btn btn-danger btn-md">Clear</a>
            </div>
        </div>
    </div>
</form>
