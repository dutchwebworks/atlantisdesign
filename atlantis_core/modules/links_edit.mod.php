<?php
// show links list
class mod_link_edit{

	// parameters	
	var $template = "backend_link_edit.tmp";
	var $id;
	var $heading;
	var $description;
	var $url;
	var $active;
	
	// strip html and rest crap
	function strip(){	
		$this->heading = addslashes(strip_tags(trim($this->heading)));
		$this->description = addslashes(strip_tags(trim($this->description)));
		$this->url = addslashes(strip_tags(trim($this->url)));
	}	
	
	// insert
	function insert(){
		global $db_table;		
		$db = new Core_Database();
		$this->strip();
		if($this->heading && $this->url){
			if($db->db_query("INSERT INTO ".$db_table['links']." VALUES(NULL, ".$this->cat.", '".$this->heading."', '".$this->description."','".$this->url."', NOW(), '".$this->active."')")){
				$this->message = "'".$this->heading."' inserted succesfully";
				return true;
			} else{
				$this->message = "Could not insert: '".$this->heading."'";
			}			
		}
	}
	
	// update
	function update(){
		global $db_table;
		$db = new Core_Database();
		$this->strip();
		
		if($this->heading && $this->url){
		
			//die("UPDATE ".$db_table['links']." SET link_cat = ".$this->cat.", link_heading = '".$this->heading."',  link_description = '".$this->description."', link_url = '".$this->url."', link_active = '".$this->active."' WHERE link_id = ".$this->id);
		
			if($db->db_query("UPDATE ".$db_table['links']." SET link_cat = ".$this->cat.", link_heading = '".$this->heading."',  link_description = '".$this->description."', link_url = '".$this->url."', link_active = '".$this->active."' WHERE link_id = ".$this->id)){
				//header("location:".$_SERVER['PHP_SELF']."?id=".$this->id);
				$this->message = "Update succesfull";
			} else{
				$this->message = "Error on record update ID ".$this->id;
			}
		} else{
			$this->message = "Heading and a short url are required for an update";
		}
	}
	
	// delete
	function del_links($id = false){
		if(is_array($id)){
			global $db_table;		
			$db = new Core_Database();
			$db->db_query("DELETE FROM ".$db_table['links']." WHERE link_id IN (".implode(", ", $id).")");
			$this->message = count($id)." records deleted";
		} else{
			$this->message = "Could not delete items";
		}
	}
	

	// create template and fill with db stuff
	function link_form(){
		global $settings, $mod_dir, $db_table;		
		$db = new Core_Database();		
		
		$template = new Core_Template($settings['module_template_dir'].$this->template);
		
		// edits
		if($this->id){
			if($edit_link = $db->db_row("SELECT * FROM ".$db_table['links']." WHERE link_id = ".$this->id)){
				$button_name = "update";
				$button_value = "Bewaren";				
				if($edit_link['link_active']) $active_checked = "checked=\"checked\""; // active checked			
				$this->message = "Editing: '".$edit_link['link_heading']."'";
			} 
		} else{
			$button_name = "insert";
			$button_value = "Invoegen";	
		}
		
		// form button
		$template->placeholder("{button_name}", $button_name);
		$template->placeholder("{button_value}", $button_value);
		$template->placeholder("{active_checked}", $active_checked);
		
		// form inputs
		$template->placeholder("{link_id}", $edit_link['link_id']);
		$template->placeholder("{insert_heading}", $edit_link['link_heading']);
		$template->placeholder("{insert_description}", $edit_link['link_description']);
		$template->placeholder("{insert_url}", $edit_link['link_url']);
		
		// cat pulldown
		$clean_cat = $template->getblok("CAT");	
		if($cat_result = $db->db_array("SELECT * FROM ".$db_table['cat']." ORDER BY cat_heading")){
			foreach($cat_result as $db_row){
				$cat_row = $clean_cat;		// clean html
				
				// set pulldown during edit
				if($db_row['cat_id'] == $edit_link['link_cat']){
					$cat_checked = " selected=\"selected\"";
				} else{
					$cat_checked = false;			
				}
				$cat_row = str_replace("{cat_checked}", $cat_checked, $cat_row);		
		
				// normal placeholders			
				$cat_row = str_replace("{cat_value}", $db_row['cat_id'], $cat_row);
				$cat_row = str_replace("{cat_label}", $db_row['cat_heading'], $cat_row);
				
				$cat_end .= $cat_row;
			}			
			$template->placeholder("{CAT}", $cat_end);
			$template->placeholder("{message}", $this->message);
			$template->parse();
		} else{
			print("<p class=\"attention\">Cannot edit.</p>");
		}		
	}
}
?>
