<?php defined('_CSEXEC') or die; ?>
  <form method="get">
    <div class="form-group">
      <select class="form-control" id="typeSelect" name="type">
          <?php echo $this->controller->displayTypes(); ?>
      </select>
      <select class="form-control" id="levelSelect" name="level">
          <?php echo $this->controller->displayLevels(); ?>
      </select>
      <select class="form-control" id="catwalkSelect" name="catwalk">
          <?php echo $this->controller->displayCatwalks(); ?>
      </select>
      <select class="form-control" id="chairSelect" name="chair">
          <?php echo $this->controller->displayChairs(); ?>
      </select>
      <select class="form-control" id="positionSelect" name="position">
          <?php echo $this->controller->displayPositions(); ?>
      </select>
      <select class="form-control" id="statusSelect" name="status">
          <?php //echo $this->controller->displayStatus(); ?>
      </select>
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </form>