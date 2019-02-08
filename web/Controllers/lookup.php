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
            // get the database items
            $items = $this->model->getList($this->filters());
            foreach ($items as $item) 
            {
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
        
        public function sortColumns()
        {
            
        }

        public function displayTypes()
        {
            $items = $this->model->getTypeItems();
            echo '<option>Type</option>';
            foreach ($items as $item)
            {
                echo '<option>' . $item['name'] . '</option>';
            }
        }

        public function displayLevels()
        {
            $items = $this->model->getLevelItems();
            echo '<option>Level</option>';
            foreach ($items as $item)
            {
                echo '<option>' . $item['name'] . '</option>';
            }
        }

        public function displayCatwalks()
        {
            $items = $this->model->getCatwalkItems();
            echo '<option>Catwalk</option>';
            foreach ($items as $item)
            {
                echo '<option>' . $item['name'] . '</option>';
            }
        }

        public function displayChairs()
        {
            $items = $this->model->getChairItems();
            echo '<option>Chair</option>';
            foreach ($items as $item)
            {
                echo '<option>' . $item['name'] . '</option>';
            }
        }

        public function displayPositions()
        {
            $items = $this->model->getPositionItems();
            echo '<option>Position</option>';
            foreach ($items as $item)
            {
                echo '<option>' . $item['name'] . '</option>';
            }
        }

        public function displayStatus()
        {
            $items = $this->model->getStatusItems();
            echo '<option>Status</option>';
            foreach ($items as $item)
            {
                echo '<option>' . $item['name'] . '</option>';
            }
        }
        
        public function filters()
        {
            // start with empty value
            $query = "";
            
            // assign get values if they have them
            $filterType = isset($_GET['type']) ? $_GET['type'] : '';
            $filterLevel = isset($_GET['level']) ? $_GET['level'] : '';
            $filterCatwalk = isset($_GET['catwalk']) ? $_GET['catwalk'] : '';
            $filterChair = isset($_GET['chair']) ? $_GET['chair'] : '';
            $filterPosition = isset($_GET['position']) ? $_GET['position'] : '';
            $filterStatus = isset($_GET['status']) ? $_GET['status'] : '';
            
            // check if dropdown list title was selected
            if( $filterType == "Type") { $filterType = ''; }
            if( $filterLevel == "Level") { $filterLevel = ''; }
            if( $filterCatwalk == "Catwalk") { $filterCatwalk = ''; }
            if( $filterChair == "Chair") { $filterChair = ''; }
            if( $filterPosition == "Position") { $filterPosition = ''; }
            if( $filterStatus == "Status") { $filterStatus = ''; }
            
            /*
            * START filter conditions for every posible combination
            */
            if( !empty($filterType) || 
                !empty($filterLevel) ||
                !empty($filterCatwalk) ||
                !empty($filterChair) ||
                !empty($filterPosition) ||
                !empty($filterStatus)) {

                    $query .= " WHERE";

            }

            if( !empty($filterType)) {
                    $query .= " ty.name='$filterType'";
            }


            if( !empty($filterType) && 
                !empty($filterLevel)) {
                    $query .= " AND";
            }

            if( !empty($filterLevel)) {
                    $query .= " le.name='$filterLevel'";
            }

            if( (!empty($filterType) && 
                !empty($filterCatwalk)) ||
                (!empty($filterLevel) &&
                !empty($filterCatwalk))) {
                    $query .= " AND";
            }

            if( !empty($filterCatwalk)) {
                    $query .= " cat.name='$filterCatwalk'";
            }

            if( (!empty($filterType) && 
                !empty($filterChair)) ||
                (!empty($filterLevel) &&
                !empty($filterChair)) ||
                (!empty($filterCatwalk) &&
                !empty($filterChair))) {
                    $query .= " AND";
            }
            if( !empty($filterChair)) {
                    $query .= " ch.name='$filterChair'";
            }

            if( (!empty($filterType) && 
                !empty($filterPosition)) ||
                (!empty($filterLevel) &&
                !empty($filterPosition)) ||
                (!empty($filterCatwalk) &&
                !empty($filterPosition)) ||
                (!empty($filterChair) &&
                !empty($filterPosition))) {
                    $query .= " AND";
            }

            if( !empty($filterPosition)) {
                    $query .= " pos.name='$filterPosition'";
            }


            if( (!empty($filterType) && 
                !empty($filterStatus)) ||
                (!empty($filterLevel) &&
                !empty($filterStatus)) ||
                (!empty($filterCatwalk) &&
                !empty($filterStatus)) ||
                (!empty($filterChair) &&
                !empty($filterStatus)) ||
                (!empty($filterPosition) &&
                !empty($filterStatus))) {
                    $query .= " AND";
            }

            if( !empty($filterStatus)) {
                    $query .= " s.name='$filterStatus'";
            }
            
            // return the string for filtering
            return $query;
        }
    }
?>