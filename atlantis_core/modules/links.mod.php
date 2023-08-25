<?php
// show links list
class mod_link_list{

	// parameters	
	var $limit = false;
	var $cat_split = true;
	var $cat_show = false;
	var $ul_class = "clean";
	var $show_inactive = false;
	var $template = "std_link_list.tmp";

	// create template and fill with db stuff
	function link_list(){
		global $settings, $mod_dir, $db_table;		
		$db = new Core_Database();
		
		$template = new Core_Template($settings['module_template_dir'].$this->template);
		$clean_div = $template->getblok("CAT_DIV"); 	// clean piece of cat divider
		
		$clean_block = $template->getblok("LINKS"); 	// clean piece of html block
		
		$query = "SELECT * FROM ".$db_table['links']." l, ".$db_table['cat']." c WHERE l.link_cat = c.cat_id";
		if(!$this->show_inactive) $query .=  " AND l.link_active = '1'";		
		
		if($this->cat_show) $query .= " AND link_cat = ".$this->cat_show." "; 	// add cat if needed	
		$query .= " ORDER BY c.cat_heading, l.link_heading"; 						// order	
		if($this->limit) $query .=  " LIMIT ".$this->limit; 					// Set limit to query result	
		
		if($result = $db->db_array($query)){
			$row_class = null;
			$block_row = null;
			$block_end = null;
			$cat_history = null;
			//$first_run = null;

			$block_row .= "\n<ul class=\"".$this->ul_class."\">\n";
			$row_nr = 0;

			foreach($result as $db_row){
				$block_row = "";
				$row_nr++;
		
				// categorien nalaten
				if($this->cat_split){				
					$cat_div = $clean_div;		// clean html
						
					//if($this->first_run) $cat_history = false;
						
					// Categorie nalaten
					if($db_row['cat_heading'] != $cat_history){
						$cat_div = str_replace("{cat_heading}", $db_row['cat_heading'], $cat_div);
						
						if($row_nr > 1) $block_row .= "</ul>\n";
						
						$block_row .= $cat_div."\n<ul class=\"".$this->ul_class."\">\n";
						$cat_history = $db_row['cat_heading'];

					} else{
						$cat_div = false;
					}
				}
				
				$block_row .= $clean_block;		// clean html

				// row colors
				$block_row = str_replace("{row}", $row_class % 2 ? "odd" : "even" , $block_row);
				$row_class++;							
				
				// normal placeholders			
				$block_row = str_replace("{link_id}", $db_row['link_id'], $block_row);
				$block_row = str_replace("{link_cat}", $db_row['link_cat'], $block_row);
				$block_row = str_replace("{link_heading}", $db_row['link_heading'], $block_row);
				$block_row = str_replace("{link_description}", bbcode($db_row['link_description']), $block_row);
				$block_row = str_replace("{link_url}", $db_row['link_url'], $block_row);
				$block_row = str_replace("{active}", $db_row['link_active'] ? "active" : "inactive", $block_row);				
				$block_row = str_replace("{link_date}", datum_formaat($db_row['link_date'], false, "day"), $block_row);
		
				$block_end .= $block_row;
			}
			
			$template->placeholder("{LINKS}", $block_end."</ul>\n");
			$template->cleanup_placeholders();
			$template->parse();
		} else{
			print("<p class=\"attention\">No links to display or is unavailable at this time.</p>");
		}
	}
}
?>
