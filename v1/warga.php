<?php
include("../connection.php");
include("./fwarga.php");

$db = new dbObject();
$connection = $db->getConnstring();
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        // Retrive Warga
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_wargabyid($id);
        } else {
            get_warga();
        }
        break;
    case 'POST':
        // Insert warga
        insert_warga();
        break;
    case 'PUT':
        // Update Product
        $id = intval($_GET["id"]);
        update_warga($id);
        break;
    case 'DELETE':
        // Delete Product
        $id = intval($_GET["id"]);
        delete_warga($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
