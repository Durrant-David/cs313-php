<?php
header("Access-Control-Allow-Origin: *");
$filters["type"] = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';
include 'cityCouncil.json';