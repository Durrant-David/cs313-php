<?php
defined('_CSEXEC') or die;
    class CatalogController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function displayCategories($parent = null)
        {
            // get the database items
            $items = $this->model->getCategoriesByParent($parent);
            $i = 0;
            foreach ($items as $item) 
            {
                if($i%3 == 0) {
                ?>
                <div class="row">
                <?php } ?>
                    
                        <div class="col-sm-3 panel panel-default categories">
                            <div>
                            <?php 
                                echo $item["name"]; 
                            ?>
                                <a href="categoryEdit?id=<?php echo $item["id"]; ?>"><i class="far fa-edit"></i></a>
                            </div>
                            <a href="?category=<?php echo $item["id"]; ?>">
                                <div class="categories">
                                <?php
                                    $this->displayCategoryItemImages($item["id"]);
                                ?>
                                </div>
                            </a>
                        </div>
                    
                <?php if($i%3 == 2) { ?>
                </div>
                <?php 
                    }
                $i++;
            }
        }

        public function displayCategoryItemImages($category)
        {
            // get the database items
            $items = $this->model->getCatalogByCategory($category);
            $i = 0;
            ?>
            <table>
                <tbody>
            <?php
                    foreach ($items as $item) 
                    {
                        if($i%2 == 0) {
                        ?>
                        <tr>
                        <?php } ?>
                          <td>
                            <img class="tinyimage" src="<?php echo $item["image"]; ?>">
                          </td>
                        <?php if($i%2 == 1) { ?>
                        </tr>
                        <?php 
                            }
                        $i++;
                        if ($i == 4) {
                            break;
                        }
                    }
            ?>
                </tbody>
            </table>
            <?php
        }

        public function displayCategory($category = null)
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
                        <a href="itemEdit?id=<?php echo $item["id"]; ?>"><i class="far fa-edit"></i></a>
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
                ?>
                
                <?php
            }
        }
        
        public function btnUpOneLevel($categoryId)
        {
            $category = $this->model->getCategory($categoryId);
            ?>
            <a class="btn btn-primary" href="<?php
            if ($category['parent_category_id'] == NULL ||
               $category['parent_category_id'] == 0) {
                echo "categories";
            } else {
                echo "categories?category=" . $category['parent_category_id'];
            }
            ?>">Go to Parent</a><?php
        }
        
        public function btnNewCategory($categoryId = '')
        {
            ?>
            <a class="btn btn-success" href="<?php
            if ($categoryId == '') {
                echo "categoryNew";
            } else {
                echo "categoryNew?parent=$categoryId";
            }
            ?>">New Category</a><?php
        }
        
        public function btnNewItem($categoryId = '')
        {
            ?>
            <a class="btn btn-success" href="<?php
            if ($categoryId == '') {
                echo "itemNew";
            } else {
                echo "itemNew?parent=$categoryId";
            }
            ?>">New Item</a><?php
        }
        
        public function displayCategoryList() 
        {
            // get the database items
            $items = $this->model->getCategoriesParentSort();
            
            ?>
            <option value="title">Select Category</option> 
            <?php
            foreach ($items as $item) 
            {
                $sub = "";
                for($i = 0; $i < $item['level']; $i++) {
                    $sub .= "- ";
                }
                ?>
                    <option value="<?php echo $item['id']; ?>"><?php 
                            echo $sub . $item['name']; 
                            ?></option> 
                <?php
            }
        }
        
        public function displayStatusList() 
        {
            $items = $this->model->getStatusItems();
            
            ?>
            <option value="title">Select Status</option> 
            <?php
            
            foreach ($items as $item) 
            {
                ?>
                    <option value="<?php echo $item['id']; ?>"><?php 
                            echo $item['name']; 
                            ?></option> 
                <?php
            }
        }
    }
?>