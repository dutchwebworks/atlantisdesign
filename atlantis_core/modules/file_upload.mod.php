<?PHP

// file uploader

class file_upload{

	// parameters
	var $file_to_upload;	
	var $file_new_name;	
	var $destionation_dir;
	var $max_width = 100; // in pixels
	var $jpg_quality = 60;
	var $message = "Please select a file to upload.";
	var $file_specs;
	var $template = "std_file_upload.tmp";


	// upload file
	function upload(){
		global $settings;
	
		if($this->file_to_upload) {
			if(!check_file($this->file_to_upload, $this->destionation_dir)){ // File naam mag niet nog eens bestaan
				if($imageInfo = getimagesize($this->file_to_upload)){ // Schalen
					if($imageInfo[2] == 1){//is gif
						$inputImg = imagecreatefromgif($this->file_to_upload);
					} elseif($imageInfo[2] == 2){//is jpg
						$inputImg = imagecreatefromjpeg($this->file_to_upload);
					} elseif($imageInfo[2] == 3){//png
						$inputImg = imagecreatefrompng($this->file_to_upload);
					} elseif($imageInfo[2] == 6){//bmp
						$inputImg = imagecreatefromwbmp($this->file_to_upload);
					}
					
					$srcX = imagesx($inputImg);
					$srcY = imagesy($inputImg);
					$dstY = 100;
					// $dstX = 100; // maximale breedte van een plaatje
					$dstX = $this->max_width ; // maximale breedte van een plaatje
					
					// Plaatje schalen of gewoon verplaatsen als deze kleiner is
					if($dstX < $srcX){ 
						$ratio = ($srcX / $dstX);
						$dstY  = ($srcY / $ratio);
						$outputImg = ImageCreateTrueColor($dstX, $dstY);
						imagefill($outputImg, 0, 0, imagecolorallocate($outputImg, 255, 255, 255));
						imagecopyresampled($outputImg, $inputImg,
									(($dstY - $dstY) / 2),0,0,0,
									$dstX, $dstY,
									$srcX, $srcY);
						imagedestroy($inputImg);					
						imagejpeg($outputImg, $this->destionation_dir.$this->file_new_name, $this->jpg_quality); // Move scaled file to upload dir
					} else{
						move_uploaded_file($this->file_to_upload, $this->$destionation_dir.$this->file_new_name); // Move orginal file to upload dir
					}
					@chmod($this->destionation_dir.$this->file_new_name, 0777);
					$this->message = "Document upload succesfull";				
					
					$file_specs['name'] =  $this->file_new_name;
					$this->message = $file_specs['name'];
					return true;
				}
			} else{
				$this->message = "File: '".$this->file_to_upload."' already exists.";
			}
		} else{
			$this->message = "<p>No file specified</p>";
		}
		$template = new Core_Template($settings['module_template_dir'].$this->template);
		$template->placeholder("{message}", $this->message);
		$template->parse();			
	}	

}

class file_list{

	// parameters
	var $path;
	var $order_key = "name";
	var $sort;
	var $template = "std_file_list.tmp";

	// list directory
	function get_file_list(){
		global $settings;
		$template = new Core_Template($settings['module_template_dir'].$this->template);
		$row_clean = $template->getblok("LIST");

		if($file_list = dir_to_array($this->path, $this->order_key)){
			foreach($file_list as $file){
				$row = $row_clean;
				
				// alternating row classes
				$row = str_replace("{row}", $row_class % 2 ? "odd" : "even" , $row);
				$row_class++;					
				
				$row = str_replace("{name}", $file['name'], $row);
				$row = str_replace("{type}", $file['tupe'], $row);
				$row = str_replace("{size}", get_filesize($file['size']), $row);
				$row = str_replace("{date}", datum_formaat(false, $file['date']), $row);
				
				$row_end .= $row;
			}
			$template->placeholder("{LIST}", $row_end);
			$template->parse();
		} else{
			print("<p class=\"attention\">Upload list could not be displayed.</p>");
		}
	}
	
		
	
}

?>