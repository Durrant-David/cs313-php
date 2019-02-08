<?php defined('_CSEXEC') or die; ?>
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