<?php 

/**
 * 
 */
class FileUploader {
	private static $target_directory = "/uploads";
	private static $size_limit = 50000;
	private $uploadOk = true;
	private $file_original_name;
	private $file_type;
	private $file_size;
	private $final_file_name;

	public function getTargetDir(){
		return $this->$target_directory;
	}

	public function setOriginalName($name){
		$this->file_original_name = $name;
	}

	public function getOriginalName(){
		return $this->file_original_name;
	}

	public function setFileType($type){
		$this->file_type = $name;
	}

	public function getFileType(){
		return $this->file_type;
	}

	public function setFileSize($size){
		$this->file_size = $size;
	}

	public function getFileSize(){
		return $this->file_size;
	}

	public function setFinalFileName($final_name){
		$this->file_final_name = $final_name;
	}

	public function getFinalFileName(){
		return $this->file_final_name;
	}

	public function uploadFile(){
		$file_original_name = self::$target_directory . basename($_FILES["fileToUpload"]["name"]);
		$this->file_type = strtolower(pathinfo($file_original_name,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $this->uploadOk = true;
		    } else {
		        echo "File is not an image.";
		        $this->uploadOk = false;
		    }
		}

		$this->fileTypeIsCorrect();
		$this->fileSizeIsCorrect();

		echo "File:".$this->uploadOk;

		if ($this->uploadOk == false) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], self::$target_directory)) {
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}
	}

	public function fileAlreadyExists(){
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    self::$uploadOk = false;
		}
	}

	public function saveFilePathTo(){

	}

	public function moveFile(){

	}

	public function fileTypeIsCorrect(){
		$imageFileType = $this->getFileType();
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $this->$uploadOk = false;
		}
	}

	public function fileSizeIsCorrect(){
		if ($_FILES["fileToUpload"]["size"] > self::$size_limit) {
		    echo "Sorry, your file is too large.";
		    $this->$uploadOk = false;
		}
	}

	public function fileWasSelected(){

	}


}

 ?>