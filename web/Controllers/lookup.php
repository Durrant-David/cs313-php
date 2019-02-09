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
                  <td class="col-1"><?php echo $this->activeIcon($item['status']); ?>
                    <i class="far fa-edit listIcon"></i></td>
                  <td class="col-1"><?php echo $item['type']; ?></td>
                  <td class="col-2"><?php echo $item['level']; ?></td>
                  <td class="col-4"><?php echo $item['catwalk']; ?></td>
                  <td class="col-4"><?php echo $item['number']; ?></td>
                </tr>  
                <?php
            }
        }
        
        public function activeIcon($active) 
        {
            switch ($active) {
                case "Red Tag":
                    $bulb = "black";
                    $tag = "red";
                    break;
                case "Burn Out":
                    $bulb = "black";
                    $tag = "black";
                    break;
                default:
                    $bulb = "yellow";
                    $tag = "black";
                    break;
            }
            $icon = '<i class="fas fa-lightbulb listIcon" style="color:' 
                . $bulb . 
                ';"></i>
                    <i class="fas fa-tag listIcon" style="color:' 
                . $tag . 
                ';"></i>';
            
            return $icon;
        }
        
        public function sortColumns()
        {
            //TODO sort columns when selected
        }

        public function displayDropDown($filter)
        {
            $items = $this->model->getFilterItems($filter);
            echo '<option value="' . $filter . '">' . $filter . '</option>';
            foreach ($items as $item)
            {
                echo '<option value="' . $item['name'] . '">' . $item['name'] . '</option>';
            }
        }

        public function displayStatusList()
        {
            $items = $this->model->getStatusItems();
            echo '<option value="Status">Status</option>';
            foreach ($items as $item)
            {
                echo '<option value="' . $item['name'] . '">' . $item['name'] . '</option>';
            }
        }
        
        public function selectedFuncJS()
        {
            ?>
            <script>
            function setSelectedIndex(s, v) {

                for (var i = 0; i < s.options.length; i++) {

                    if (s.options[i].text == v) {

                        s.options[i].selected = true;

                        return;

                    }

                }

            }
            </script>
            <?php
        }
        public function setSelectedJS($filter)
        {
            $filters = $this->getFilters();
            $sel = $filter . 'Select';
            ?>
            <script>
                setSelectedIndex(document.getElementById('<?php echo $sel; ?>'),"<?php echo $filters[$filter]; ?>");
            </script>
            <?php
        }
        
        public function getFilters() 
        {
            // assign get values if they have them
            $filters["type"] = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';
            $filters["level"] = isset($_GET['level']) ? htmlspecialchars($_GET['level']) : '';
            $filters["catwalk"] = isset($_GET['catwalk']) ? htmlspecialchars($_GET['catwalk']) : '';
            $filters["chair"] = isset($_GET['chair']) ? htmlspecialchars($_GET['chair']) : '';
            $filters["position"] = isset($_GET['position']) ? htmlspecialchars($_GET['position']) : '';
            $filters["status"] = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '';
            
            return $filters;
        }
        
        public function filters()
        {
            // start with empty value
            $query = "";
            
            $filters = $this->getFilters();
            
            // check if dropdown list title was selected
            if( $filters["type"] == "Type") { $filters["type"] = ''; }
            if( $filters["level"] == "Level") { $filters["level"] = ''; }
            if( $filters["catwalk"] == "Catwalk") { $filters["catwalk"] = ''; }
            if( $filters["chair"] == "Chair") { $filters["chair"] = ''; }
            if( $filters["position"] == "Position") { $filters["position"] = ''; }
            if( $filters["status"] == "Status") { $filters["status"] = ''; }
            
            /*
            * START filter conditions for every posible combination
            */
            if( !empty($filters["type"]) || 
                !empty($filters["level"]) ||
                !empty($filters["catwalk"]) ||
                !empty($filters["chair"]) ||
                !empty($filters["position"]) ||
                !empty($filters["status"])) {

                    $query .= " WHERE";

            }

            if( !empty($filters["type"])) {
                    $query .= " ty.name='" . $filters["type"] . "'";
            }


            if( !empty($filters["type"]) && 
                !empty($filters["level"])) {
                    $query .= " AND";
            }

            if( !empty($filters["level"])) {
                    $query .= " le.name='" . $filters["level"] . "'";
            }

            if( (!empty($filters["type"]) && 
                !empty($filters["catwalk"])) ||
                (!empty($filters["level"]) &&
                !empty($filters["catwalk"]))) {
                    $query .= " AND";
            }

            if( !empty($filters["catwalk"])) {
                    $query .= " cat.name='" . $filters["catwalk"] . "'";
            }

            if( (!empty($filters["type"]) && 
                !empty($filters["chair"])) ||
                (!empty($filters["level"]) &&
                !empty($filters["chair"])) ||
                (!empty($filters["catwalk"]) &&
                !empty($filters["chair"]))) {
                    $query .= " AND";
            }
            if( !empty($filters["chair"])) {
                    $query .= " ch.name='" . $filters["chair"] . "'";
            }

            if( (!empty($filters["type"]) && 
                !empty($filters["position"])) ||
                (!empty($filters["level"]) &&
                !empty($filters["position"])) ||
                (!empty($filters["catwalk"]) &&
                !empty($filters["position"])) ||
                (!empty($filters["chair"]) &&
                !empty($filters["position"]))) {
                    $query .= " AND";
            }

            if( !empty($filters["position"])) {
                    $query .= " pos.name='" . $filters["position"] . "'";
            }


            if( (!empty($filters["type"]) && 
                !empty($filters["status"])) ||
                (!empty($filters["level"]) &&
                !empty($filters["status"])) ||
                (!empty($filters["catwalk"]) &&
                !empty($filters["status"])) ||
                (!empty($filters["chair"]) &&
                !empty($filters["status"])) ||
                (!empty($filters["position"]) &&
                !empty($filters["status"]))) {
                    $query .= " AND";
            }

            if( !empty($filters["status"])) {
                    $query .= " s.name='" . $filters["status"] . "'";
            }
            /* END */
            
            // return the string for filtering
            return $query;
        }
    }
?>