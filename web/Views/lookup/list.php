<?php defined('_CSEXEC') or die; ?>
<style>
    .listIcon {
        color: black;
        font-size: 26px;
        text-shadow:2px 2px 4px #000000;
        padding: 4px;
    }
</style>
<div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Type</th>
          <th scope="col">Level</th>
          <th scope="col">Catwalk</th>
          <th scope="col">Number</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
            echo $this->controller->displayList();  
        ?>
      </tbody>
    </table>
</div>