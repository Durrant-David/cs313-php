<?php
defined('_CSEXEC') or die;
    class LookupController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function displayList()
        {
            $items = $this->model->getList();
            foreach ($items as $item) {
                ?>
                <tr>
                  <th scope="row"><?php echo $item['type']; ?></th>
                  <td><?php echo $item['level']; ?></td>
                  <td><?php echo $item['catwalk']; ?></td>
                  <td><?php echo $item['number']; ?></td>
                  <td><?php echo $item['status']; ?></td>
                </tr>  
                <?php
            }
        }


    }
?>