<?php defined('_CSEXEC') or die; ?>
<style>
    .listIcon {
        color: black;
        font-size: 26px;
        text-shadow:2px 2px 4px #000000;
    }
</style>
<div class="container">
    <table class="table">
      <thead>
        <tr>
          <th class="col-xs-2">Status</th>
          <th class="col-xs-2">Type</th>
          <th class="col-xs-2">Level</th>
          <th class="col-xs-2">Catwalk</th>
          <th class="col-xs-4">Number</th>
        </tr>
      </thead>
      <tbody>
        <?php
            echo $this->controller->displayList();  
        ?>
      </tbody>
    </table>
</div>