<?php defined('_CSEXEC') or die; 

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$status = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '';
$this->model->setStatus($id, $status);
?>

