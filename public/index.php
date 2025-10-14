<?php
require_once __DIR__ . '/../app/Controller/bookController.php';


$controller = new bukuController();
$action = $_GET['action'] ?? 'index';

$id = $_GET['id'] ?? null;

switch ($action) {


    case 'create':
        $controller->create();
        break;

    case 'edit':
        $controller->edit($id);
        break;

    case 'delete':
        $controller->delete($id);
        break;

    default:
        $controller->index();
        break;
}
