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
            /*$items = $this->model->getList($this->filters());
            foreach ($items as $item) 
            {
                ?>
                <tr>
                  <td class="col-1">
                      <?php echo $this->activeIcon($item['id'], $item['status']); ?>
                      <a href="edit?id=<?php echo $item["id"]; ?>"><i class="far fa-edit listIcon"></i></a></td>

                  <td class="col-1"><?php /*echo $item['type']; ?></td>
                  <td class="col-2"><?php echo $item['level']; ?></td>
                  <td class="col-4"><?php echo $item['catwalk']; ?></td>
                  <td class="col-4"><?php echo $item['number']; </td>

                </tr>  
                <?php
            }*/
        }

        public function toJSON()
        {
            // get the database items
            $items = $this->model->getList($this->filters());
            echo json_encode($items);
        }
        
        public function activeIcon($id, $active) 
        {
            switch ($active) {
                case "Red Tag":
                    $bulb = "black";
                    $tag = "red";
                    break;
                case "Burn Out":
                    $bulb = "red";
                    $tag = "black";
                    break;
                default:
                    $bulb = "yellow";
                    $tag = "black";
                    break;
            }
            $icon = '<i onclick="toggleLight(' . $id . ', \'' . $active . '\')" 
            class="fas fa-lightbulb listIcon" style="color:' 
                . $bulb . 
                ';"></i>
                    <i onclick="toggleTag(' . $id . ', \'' . $active . '\')" 
                    class="fas fa-tag listIcon" style="color:' 
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
        
        public function editItem($id)
        {
            // get the database items
            $item = $this->model->getLookupItem($id);
            foreach ($item as $values) 
            {
                ?>
                <tr>
                  <td class="col-1"><?php echo $this->activeIcon($values['status']); ?>
                      <a href="edit"><i class="far fa-edit listIcon"></i></a></td>
                  <td class="col-1"><?php echo $values['type']; ?></td>
                  <td class="col-2"><?php echo $values['level']; ?></td>
                  <td class="col-4"><?php echo $values['catwalk']; ?></td>
                  <td class="col-4"><?php echo $values['number']; ?></td>
                </tr>  
                <?php
            }
        }
        
        public function selectFixture()
        {
            // get the database items
            $items = $this->model->getFixtureList();
            foreach ($items as $item) 
            {
                ?>
                <tr onclick="setSelected(this
                                     .childNodes[1]
                                     .childNodes[1]
                                     .childNodes[1]
                                     .childNodes[1].id)">
                    <td class="col-4">
                        <div class="radio">
                        <label>
                            <input name="fixtures" type="radio" id="<?php echo $item['id']; ?>">
                        </label>
                        </div>
                    </td>
                    <td class="col-4">
                        <?php echo $item['catwalk']; ?>
                    </td>
                    <td class="col-4">
                        <?php echo $item['number']; ?>
                    </td>
                </tr>  
                <?php
            }
        }
        
        public function selectedFixture($id)
        {
            // get the database items
            $items = $this->model->getFixtureItem($id);
            foreach ($items as $item) 
            {
                ?>
                <tr>
                    <td class="col-4">
                        <?php echo $item['catwalk']; ?>
                    </td>
                    <td class="col-4">
                        <?php echo $item['number']; ?>
                    </td>
                </tr>  
                <?php
            }
        }
        
        public function loadItemValues($id)
        {
            $items = $this->model->getLookupItem($id);
            foreach ($items as $item) 
            {
                ?>
                SelectElement("type", "<?php echo $item['type']; ?>");
                SelectElement("level", "<?php echo $item['level']; ?>");
                SelectElement("catwalk", "<?php echo $item['catwalk']; ?>");
                SelectElement("chair", "<?php echo $item['chair']; ?>");
                SelectElement("position", "<?php echo $item['position']; ?>");
<!--     TODO setup status           SelectElement("status", "<?php echo $item['status']; ?>");-->
                <?php if($item['fixture_id'] != '') { ?>
                    document.getElementById("<?php echo $item['fixture_id']; ?>").checked = true;
                <?php } ?>

                window.onload = loadFixture(<?php echo $item['fixture_id']; ?>);
                <?php
            }
        }
        
        public function updateItem($values) {
            $type = $this->model->getItemId("type", $values["type"]);
            $level = $this->model->getItemId("level", $values["level"]);
            $catwalk = $this->model->getItemId("catwalk", $values["catwalk"]);
            $chair = $this->model->getItemId("chair", $values["chair"]);
            $position = $this->model->getItemId("position", $values["position"]);
            
            $values["type"] = $type;
            $values["level"] = $level;
            $values["catwalk"] = $catwalk;
            $values["chair"] = $chair;
            $values["position"] = $position;
            
            $this->model->setLookupItem($values);
        }

    }

?>