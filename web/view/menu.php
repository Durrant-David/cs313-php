<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">CS 313</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <?php 
          include 'controller/menu.php';
          $items = getMenuItems();
          $itemCount = count($items);
          //var_dump($dbResults);
          foreach ($items as $item) {
              if($item["parent"] == 0){
                  $noSubItem = true;
                  $i = 0;
                  foreach ($items as $subitem) {
                      if($subitem["parent"] == $item["id"]){
                          if($noSubItem == true) {
                              ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $item["link"]; ?>"><?php echo $item["title"]; ?><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                              <?php
                              $noSubItem = false;
                          }
                          echo '<li><a href="' . $subitem["link"] .'">' . $subitem["title"] . '</a></li>';
                          if($i == $itemCount - 1) {
                            echo '</ul></li>';
                          }
                      }
                      echo $itemCount;
                      $i++;
                  }
                  if($noSubItem == true){
                      echo '<li><a href="' . $item["link"] .'">' . $item["title"] . '</a></li>';
                  }
              }
          }
          ?>
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
    </div>
  </div>
</nav>