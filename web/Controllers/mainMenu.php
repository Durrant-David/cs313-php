<?php
defined('_CSEXEC') or die;
    class MainMenuController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function menuItems()
        {
            $items = $this->model->getMenuItems();
            $itemCount = count($items);
            foreach ($items as $item) {
                if($item["parent"] == 0){
                    $noSubItem = true;
                    foreach ($items as $subitem) {
                        if($subitem["parent"] == $item["id"]){
                            if($noSubItem == true) {
                            ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $item["link"]; ?>">
                                        <?php echo $item["title"]; ?><span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <?php
                                            $noSubItem = false;
                            }
                            echo '<li><a href="' . $subitem["link"] .'">' . $subitem["title"] . '</a></li>';
                        }
                    }
                    if($noSubItem == true){
                        echo '<li><a href="' . $item["link"] .'">' . $item["title"] . '</a></li>';
                    } else {
                        echo '</ul></li>';
                    }
                }
            }
        }


    }
?>