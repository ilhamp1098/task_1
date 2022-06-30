<?php
require_once "db_config.php";
class Provinsi 
{

	public  function get_provinsi()
	{
		global $conn;
		$query="SELECT * FROM provinsi";
		$data=array();
		$result=$conn->query($query);
		while($row=mysqli_fetch_object($result))
		{
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get List Provinsi Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get_provinsi_v($id=0)
	{
		global $conn;
		$query="SELECT * FROM provinsi";
		if($id != 0)
		{
			$query.=" WHERE id=".$id." LIMIT 1";
		}
		$data=array();
		$result=$conn->query($query);
		while($row=mysqli_fetch_object($result))
		{
			$data[]=$row;
		}
		$response=array(
							'status' => 1,
							'message' =>'Get Provinsi Successfully.',
							'data' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

	public function insert_provinsi()
		{
			global $conn;
$nama = $_POST['nama'];

$fileName  =  $_FILES['sendimage']['name'];
$tempPath  =  $_FILES['sendimage']['tmp_name'];
$fileSize  =  $_FILES['sendimage']['size'];

			$arrcheckpost = array('nama' => '');
			$hitung = count(array_intersect_key($_POST, $arrcheckpost));

if(empty($fileName))
{
	$response=array(
							'status' => 0,
							'message' =>'please select image'
						);
}
else
{			

			
	$upload_path = 'upload/'; // set upload folder path 
	
	$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
		
	// valid image extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
					
	// allow valid image file formats
	if(in_array($fileExt, $valid_extensions))
	{				
		//check file not exist our upload folder path
		if(!file_exists($upload_path . $fileName))
		{
			// check file size '5MB'
			if($fileSize < 5000000){
				move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
			}
			else{	
				$response=array(
							'status' => 0,
							'message' =>'Sorry, your file is too large, please upload 5 MB size'
						);	
			}
		}
		else
		{		
			$response=array(
							'status' => 0,
							'message' =>'Sorry, file already exists check upload folder'
						);
		}
	}
	else
	{	
		$response=array(
							'status' => 0,
							'message' =>'Sorry, only JPG, JPEG, PNG & GIF files are allowed'
						);	
		
	}
}

if(!isset($response))
{
			if($hitung == count($arrcheckpost)){	

					$result = mysqli_query($conn,'INSERT into provinsi (nama,foto) VALUES("'.$nama.'","'.$fileName.'")');
					
					if($result)
					{
						$response=array(
							'status' => 1,
							'message' =>'Provinsi Added Successfully.'
						);
					}
					else
					{
						$response=array(
							'status' => 0,
							'message' =>'Provinsi Addition Failed.'
						);
					}
			}else{
				$response=array(
							'status' => 0,
							'message' =>'Parameter Do Not Match'
						);
			}
}			
			
			header('Content-Type: application/json');
			echo json_encode($response);
		}


	function update_provinsi($id)
		{
			global $conn;

$nama = $_POST['nama'];

$fileName  =  $_FILES['sendimage']['name'];
$tempPath  =  $_FILES['sendimage']['tmp_name'];
$fileSize  =  $_FILES['sendimage']['size'];			
			$arrcheckpost = array('nama' => '');
			$hitung = count(array_intersect_key($_POST, $arrcheckpost));
			if($hitung == count($arrcheckpost)){
			
$upload_path = 'upload/';

move_uploaded_file($tempPath, $upload_path . $fileName);

		        $result = mysqli_query($conn, 'UPDATE provinsi SET
		        nama = "'.$nama.'",
				foto = "'.$fileName.'"
		        WHERE id="'.$id.'"');
		   
				if($result)
				{
					$response=array(
						'status' => 1,
						'message' =>'Provinsi Updated Successfully.'
					);
				}
				else
				{
					$response=array(
						'status' => 0,
						'message' =>'Provinsi Updation Failed.'
					);
				}
			}else{
				$response=array(
							'status' => 0,
							'message' =>'Parameter Do Not Match'
						);
			}
			header('Content-Type: application/json');
			echo json_encode($response);
		}


	function delete_provinsi($id)
	{
		global $conn;
		$query="DELETE FROM provinsi WHERE id=".$id;
		if(mysqli_query($conn, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Provinsi Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Provinsi Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}

 ?>