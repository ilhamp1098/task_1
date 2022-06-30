<?php
require_once "method.php";
$prvns = new Provinsi();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
	case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				 $prvns->get_provinsi_v($id);
			}
			else
			{
				$prvns->get_provinsi();
			}
			break;
	case 'POST':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$prvns->update_provinsi($id);
			}
			else
			{
				$prvns->insert_provinsi();
			}		
			break; 
	case 'DELETE':
		    $id=intval($_GET["id"]);
            $prvns->delete_provinsi($id);
            break;
	default:
		// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
		break;
}




?>