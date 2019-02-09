<?php
defined('_CSEXEC') or die;
    class CatalogController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function displayCategories()
        {
            // get the database items
            $items = $this->model->getCategory();
            $i = 0;
            foreach ($items as $item) 
            {
                if($i%3 == 0) {
                ?>
                <div class="row">
                <?php } ?>
                  <div class="col-sm-3">
                      <a href="?category=<?php echo $item["name"]; ?>">
                        <?php echo $item["name"]; ?>
                      </a>
                    </div>
                <?php if($i%3 == 2) { ?>
                </div>
                <?php 
                    }
                $i++;
            }
        }

        public function displayCategory($category)
        {
            // get the database items
            $items = $this->model->getCatalogByCategory($category);
            $i = 0;
            foreach ($items as $item) 
            {
                if($i%3 == 0) {
                ?>
                <div class="row">
                <?php } ?>
                  <div class="col-sm-3 product">
                      <div>
                        <?php echo $item["name"]; ?>
                      </div>
                      <div>
                        <img src="<?php echo $item["image"]; ?>">
                      </div>
                      <div>
                        <?php echo $item["location"]; ?>
                      </div>
                      <div>
                        <?php echo $item["status"]; ?>
                      </div>
                      <div>
                        <?php echo $item["description"]; ?>
                      </div>
                    </div>
                <?php if($i%3 == 2) { ?>
                </div>
                <?php 
                    }
                $i++;
            }
        }
    }
?>