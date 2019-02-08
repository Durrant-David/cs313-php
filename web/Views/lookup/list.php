<?php defined('_CSEXEC') or die; ?>
<style>
    i {
        color: black;
        font-size: 32px;
        text-shadow:2px 2px 4px #000000;
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