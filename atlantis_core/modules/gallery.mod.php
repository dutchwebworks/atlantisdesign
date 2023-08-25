<?PHP


// display gallery items
class mod_gallery_list{

	// parameters
	var $cat_id = false;
	var $cat_split = true;
	var $start_id = false;
	var $show_inactive = false;
	var $max_page_items = false; // items to display on a page
	var $template = "std_gallery_list.tmp";

	// create list of gallery with or without cat filter
	function gallery_list(){
		global $settings, $mod_dir, $db_table;		
		$db = new Core_Database();	
		
		$template = new Core_Template($settings['backend'].$settings['module_template_dir'].$this->template);
		$clean_div = $template->getblok("CAT_DIV");			// clean categorie divider
		$clean_block = $template->getblok("GALLERY_LIST");	// clean html
	
		// main query
		$query = "SELECT * FROM ".$db_table['gallery']." g, ".$db_table['cat']." c WHERE g.gal_cat = c.cat_id";
		if($this->cat_id) $query .= " AND g.gal_cat = ".$this->cat_id;
		if(!$this->show_inactive) $query .= " AND g.gal_active = '1'";
		
		//$query .= " ORDER BY g.gal_cat, g.gal_heading";
		$query .= " ORDER BY c.cat_heading, g.gal_insert_date DESC";
		
		if($this->max_page_items) $query .= " LIMIT ".$this->max_page_items;

		$cat_history = null;
		$row_class = null;
		$block_end = null;
		
		if($result = $db->db_array($query)){
			foreach($result as $db_row){
				$block_row = $clean_block;		// clean html	
				
				// categorie divider
				if($this->cat_split){
					$cat_div = $clean_div;		// clean html
					
					if($db_row['cat_heading'] != $cat_history){
						$cat_div = str_replace("{cat_heading}", $db_row['cat_heading'], $cat_div);
						$cat_history = $db_row['cat_heading'];
					} else{
						$cat_div = false;
					}
				}
				$block_row = str_replace("{CAT_DIV}", $cat_div, $block_row);
				
				// alternating row classes
				$block_row = str_replace("{row}", $row_class % 2 ? "odd" : "even" , $block_row);
				$row_class++;		
				
				// normal placeholders
				$block_row = str_replace("{gal_id}", $db_row['gal_id'], $block_row);
				$block_row = str_replace("{gal_cat}", $db_row['gal_cat'], $block_row);
				$block_row = str_replace("{gal_heading}", $db_row['gal_heading'], $block_row);
				$block_row = str_replace("{gal_body}", $db_row['gal_body'], $block_row);
				$block_row = str_replace("{gal_img_large}", $settings['gallery_upload_large'].$db_row['gal_img'], $block_row);
				$block_row = str_replace("{gal_img_thumb}", $settings['gallery_upload_thumb'].$db_row['gal_img'], $block_row);				
				$block_row = str_replace("{gal_insert_date}", datum_formaat($db_row['gal_insert_date'], false, "day"), $block_row);
						
				$block_end .= $block_row;
			}
			$template->placeholder("{GALLERY_LIST}", $block_end);
			$template->parse();
		} else{
			print("<p class=\"attention\">No gallery to display or is unavailable at this time.</p>");
		}
	}
	
	function slideShowList(){
		global $settings, $mod_dir, $db_table;		
		$db = new Core_Database();	
		
		// main query
		$query = "SELECT * FROM ".$db_table['gallery']." g, ".$db_table['cat']." c WHERE g.gal_active = '1' AND g.gal_cat = c.cat_id";
		if($this->cat_id) $query .= " AND g.gal_cat = ".$this->cat_id;
		$query .= " ORDER BY g.gal_insert_date DESC";
		
		if($result = $db->db_array($query)){
			foreach($result as $db_row){
				$heading .= "'".addslashes($db_row['gal_heading'])."',";
				$body .= "'".addslashes($db_row['gal_body'])."',";
				$date .= "'".datum_formaat($db_row['gal_insert_date'])."',";
				$img .= "'".$settings['gallery_upload_large'].$db_row['gal_img']."',";
			}
			$this->heading = substr($heading, 0, -1);
			$this->body = substr($body, 0, -1);
			$this->date = substr($date, 0, -1);
			$this->img = substr($img, 0, -1);

		} 			
	}
}


// display gallery page/slide
class mod_gallery_detail{

	// parameters
	var $detail_id = 0;
	var $cat_id = 0;
	var $radom;
	var $template = "std_gallery_detail.tmp";
	
	// create page for detailed slide
	function gallery_detail(){
		global $settings, $mod_dir, $db_table;		
		$db = new Core_Database();	
		
		$template = new Core_Template($settings['backend'].$settings['module_template_dir'].$this->template);
		$page_list_clean = $template->getblok("PAGE_LIST");
		$previous_page_clean = $template->getblok("PREVIOUS_PAGE");
		$next_page_clean = $template->getblok("NEXT_PAGE");
		
		$query = "SELECT * FROM ".$db_table['gallery']." WHERE gal_active = 1";
		
		if($this->detail_id) $id = " AND gal_id = ".$this->detail_id;			
		if($this->cat_id) $cat = " AND gal_cat = ".$this->cat_id;
		if($this->random) $random = " AND gal_active = 1 ORDER BY RAND() LIMIT 1";

		$query .= $id.$cat.$random;

		if($result = $db->db_row($query)){	
		
			// normal placeholders
			$template->placeholder("{gal_id}", $result['gal_id']);
			$template->placeholder("{gal_cat}", $result['gal_cat']);
			$template->placeholder("{gal_heading}", $result['gal_heading']);			
			$template->placeholder("{gal_body}", $result['gal_body']);
			$template->placeholder("{gal_img}", $settings['gallery_upload_large'].$result['gal_img']);
			$template->placeholder("{gal_insert_date}", datum_formaat($result['gal_insert_date'], false, "day"));
			
			
			// next and previous buttons
			if($page_result = $db->db_colum("SELECT gal_id FROM ac_gallery WHERE gal_cat = ".$this->cat_id." AND gal_active = '1' ORDER BY gal_insert_date DESC")){	
				for($i = 0; $i <= count($page_result); $i++){			
					
					// page list					
					if($page_result[$i] == $this->detail_id){			
						$l = $i;					
						// place link to next page
						if($page_result[$l+1]){							
							$next_page = $next_page_clean;
							$next_page = str_replace("{next_id}", $page_result[$l+1], $next_page);
							$next_page = str_replace("{gal_cat}", $this->cat_id, $next_page);							
						}						
						// place link to previous page
						if($page_result[$l-1]){
							$previous_page = $previous_page_clean;
							$previous_page = str_replace("{previous_id}", $page_result[$l-1], $previous_page);
							$previous_page = str_replace("{gal_cat}", $this->cat_id, $previous_page);
						}
					}
					
					// break 1 loop before end					
					$l = $i;					
					if($l == count($page_result)-1){
						break;
					}						
					
					// create current page css class
					$page_list = $page_list_clean;	
					if($page_result[$i+1] == $this->detail_id){
						$page_class = "page_current"; // css class name for current page
					} else{
						$page_class = "page_link";
					}					
					
					// generating pagelist									
					$page_list = str_replace("{page_number}", $l+1, $page_list);
					$page_list = str_replace("{galllery_id}", $this->detail_id, $page_list);
					$page_list = str_replace("{gal_cat}", $this->cat_id, $page_list);
					$page_list = str_replace("{page_current}", $page_class, $page_list);
					$page_list = str_replace("{gallery_id}", $page_result[$l+1], $page_list);
					$page_list_end .= $page_list;		
				}
				
			}
			$template->placeholder("{PAGE_LIST}", $page_list_end);
			$template->placeholder("{NEXT_PAGE}", $next_page);
			$template->placeholder("{PREVIOUS_PAGE}", $previous_page);
			$template->placeholder("{php_self}", $_SERVER['PHP_SELF']);

			// return template
			$template->parse();	
		} else{
			print("<p class=\"attention\">The details on this gallery item cannot be displayed or is unavailable at this time.</p>");
		}
	}
	
	function getMetaData(){
		global $db_table;
		$db = new Core_Database();	
		if($this->detail_id){
			if($result = $db->db_row("SELECT gal_heading title, gal_body description, gal_body keywords, gal_insert_date date FROM ".$db_table['gallery']." WHERE gal_id = ".$this->detail_id)){
				return $result;
			}
		} else{
			print("No keywords available");
		}
	}

}

?>