<?PHP

// article list module
class mod_article_list{

	// parameters
	var $message;
	var $limit = false;
	var $cat_split = true;
	var $cat_show = false;
	var $short_intro = false;
	var $show_inactive = false;
	var $template = "std_article_list.tmp";
	
	// list of articles
	function article_list(){
		global $settings, $mod_dir, $db_table, $backend;
		
		$db = new Core_Database();	
		
		$template = new Core_Template($settings['module_template_dir'].$this->template);
		$clean_div = $template->getblok("CAT_DIV");		// clean categorie divider
		$clean_block = $template->getblok("ITEMS");		// clean html
		
		$query = "SELECT *, REPLACE(a.art_heading, ' ', '') link_heading FROM ".$db_table['article']." a, ".$db_table['cat']." c WHERE a.art_cat = c.cat_id";
		
		if(!$settings['backend']) $query .= " AND a.art_date_insert < NOW()"; // AND NOW() < a.art_date_end";
		if(!$this->show_inactive) $query .= " AND a.art_active = '1'";
		
		if($this->cat_show) $query .= " AND art_cat = ".$this->cat_show." "; 	// add cat if needed	
		
		// backend order is anders
		if($settings['backend']){
			$query .= " ORDER BY c.cat_heading, a.art_heading"; 			// order
		} else{
			$query .= " ORDER BY c.cat_heading, a.art_date_insert DESC"; 	// order
		}		
		
		
		if($this->limit) $query .=  " LIMIT ".$this->limit; 					// set limit to query result

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
				
				// row colors
				$block_row = str_replace("{row}", $row_class % 2 ? "odd" : "even" , $block_row);
				$row_class++;				
				
				// normal placeholders
				if($backend){ // backend works on ID's
					$block_row = str_replace("{art_id}", $db_row['art_id'], $block_row); // mod_rewrite op ID
				} else{
					//$block_row = str_replace("{art_id}", $db_row['link_heading'], $block_row); // mod_rewrite op naam
					$block_row = str_replace("{art_id}", $db_row['art_id'], $block_row); // mod_rewrite op ID
				}
								
				$block_row = str_replace("{art_heading}", $db_row['art_heading'], $block_row);
				
				if($this->short_intro){
					$block_row = str_replace("{art_intro}", substr($db_row['art_intro'], 0, 50)." ...", $block_row);
				} else{
					$block_row = str_replace("{art_intro}", $db_row['art_intro'], $block_row);
				}				
				
				$block_row = str_replace("{art_date_insert}", datum_formaat($db_row['art_date_insert'], false, "day"), $block_row);
				$block_row = str_replace("{art_date_mod}", datum_formaat($db_row['art_date_mod'], false, "day"), $block_row);
				$block_row = str_replace("{art_date_end}", datum_formaat($db_row['art_date_end'], false, "day"), $block_row);
				

				// mod_rewrite search by postname
				$block_row = str_replace("{art_postname}", $db_row['art_postname'], $block_row);
				
				//check to set css class for expired article <= werkt niet met MySQL 4.1!!
				$now = datum_formaat(false, time(), "mysql_full");
				if($db_row['art_date_end'] < $now){
					$expired = " expired";
				} else{
					$expired = false;
				}
				$block_row = str_replace("{expired}", $expired, $block_row);
				
				
				// active status
				$block_row = str_replace("{art_active}", $db_row['art_active'] ? "active" : "inactive", $block_row);
						
				$block_end .= $block_row;
			}
			$template->placeholder("{ITEMS}", $block_end);
			$template->placeholder("{message}", $this->message);
			$template->parse();
			return true;
		} else{
			print("<p>Could not delete items</p>");
		}
	}
	
	// delete articles
	function del_article($id = false){
		if(is_array($id)){
			global $db_table;		
			$db = new Core_Database();
			$db->db_query("DELETE FROM ".$db_table['article']." WHERE art_id IN (".implode(", ", $id).")");
			$this->message = count($id)." records deleted";
		} else{
			$this->message = "Could not delete items";
		}
	}	
}
	

// article detail page
class mod_article_detail{
	
	// parameters
	var $article_id = 0;
	var $postname = 0; // mod_rewrite search by postname column in db
	var $template = "std_article_detail.tmp";
	
	// display detail on article
	function article_detail(){
		global $settings, $mod_dir, $db_table;
		
		$db = new Core_Database();
			
		$template = new Core_Template($settings['module_template_dir'].$this->template);
		// op naam voor mod_rewrite
		//$query = "SELECT * FROM ".$db_table['article']." a, ".$db_table['cat']." c WHERE a.art_cat = c.cat_id AND REPLACE(a.art_heading, \" \", \"\") = '".$this->article_id."' AND a.art_active = '1'";
		
		// op ID voor orginele scripting
		$query = "SELECT * FROM ".$db_table['article']." a, ".$db_table['cat']." c WHERE a.art_cat = c.cat_id ";
		
		// check for article id or postname (mod_rewrite)
		if($this->article_id) {
			$query .= "AND a.art_id = ".$this->article_id;
		} elseif($this->postname) {
			$query .= "AND art_postname = '".$this->postname."'";
		}
		
		$query .= " AND a.art_active = '1'";

		if($result = $db->db_row($query)){
			$template->placeholder("{art_intro}", bbcode($result['art_intro']));
			$template->placeholder("{art_heading}", $result['art_heading']);
			$template->placeholder("{cat_heading}", $result['cat_heading']);
			$template->placeholder("{art_intro}", bbcode($result['art_intro']));
			$template->placeholder("{art_body}", bbcode($result['art_body']));
			$template->placeholder("{art_date_mod}", datum_formaat($result['art_date_mod'], false, "day"));
			$template->placeholder("{art_date_insert}", datum_formaat($result['art_date_insert'], false, "day"));
			$template->placeholder("{art_date_end}", datum_formaat($result['art_date_end'], false, "day"));
			$template->parse();
		} else{
			print("<p class=\"attention\">This article cannot be displayed or is unavailable at this time.</p>");
		}
	}
	
	function getMetaData(){
		global $db_table;
		$db = new Core_Database();	
		if($this->article_id || $this->postname){
	
			$meta_query = "SELECT art_heading title, art_intro description, art_keywords keywords, art_date_mod date FROM ".$db_table['article']." WHERE ";

			// use either artcile id or postname (mod_rewrite)
			if($this->article_id) {
				$meta_query .= " art_id = ".$this->article_id;				
			} elseif($this->postname) {
				$meta_query .= " art_postname = '".$this->postname."'";
			}

			if($result = $db->db_row($meta_query)){
				// strip the slashes
				$result['description'] = stripslashes($result['description']);
				$result['keywords'] = stripslashes($result['keywords']);
				$result['date'] = stripslashes($result['date']);
			
				return $result;
			}
		} else{
			print("No keywords available");
		}
	}
	
	function getIntro() {
		global $db_table;	
		$db = new Core_Database();
		$result = $db->db_row("SELECT art_intro  FROM ".$db_table['article']." WHERE art_postname = \"".$this->postname."\" LIMIT 1");
		print($result["art_intro"]);
	}
}


// edit acrticle
class mod_article_edit{

	// parameters
	var $message = "New article";
	var $id = 0;
	var $cat;
	var $intro;
	var $heading;
	var $body;
	var $date_mod;
	var $date_insert;
	var $date_end = "20600101000000"; // max lifespan of article if no date
	var $active = 1; // standard active
	
	var $template = "backend_article_edit.tmp";	
	
	// strip html and rest crap
	function strip(){	
		$this->heading = addslashes(strip_tags(trim($this->heading)));
		$this->intro = addslashes(strip_tags(trim($this->intro)));
		$this->keywords = addslashes(strip_tags(trim($this->keywords)));
		$this->body = addslashes(strip_tags(trim($this->body)));
	}
	
	// create postname for mod_rewrite
	function generatePostname(){
		return ereg_replace("[^A-Za-z0-9_]", "-", strtolower(trim(stripslashes(strip_tags($this->heading)))));
	}
	
	// update article
	function update(){
		global $db_table;		
		$db = new Core_Database();
		$this->strip();
		
		if($this->heading && $this->intro){
			if($db->db_query("UPDATE ".$db_table['article']." SET art_id = ".$this->id.", art_cat = ".$this->cat.", art_intro = '".$this->intro."',  art_keywords = '".$this->keywords."', art_heading = '".$this->heading."',  art_postname = '".$this->generatePostname()."', art_body = '".addslashes($this->body)."', art_date_end = ".$this->date_end.",  art_active = '".$this->active."' WHERE art_id = ".$this->id)){
				//header("location:".$_SERVER['PHP_SELF']);
				$this->message = "Update succesfull";
			} else{
				$this->message = "Error on record update ID ".$this->id;
			}
		} else{
			$this->message = "Heading and a short discription are required for an update";
		}
	}
	
	
	// insert article
	function insert(){
		global $db_table;		
		$db = new Core_Database();
		$this->strip();
		if($this->heading && $this->intro){
			if($db->db_query("INSERT INTO ".$db_table['article']." VALUES(NULL, ".$this->cat.", '".$this->intro."', '".$this->keywords."', '".$this->heading."', '".$this->generatePostname()."', '".addslashes($this->body)."', NOW(), NOW(), ".$this->date_end.", '".$this->active."')")){
				$this->message = "Insert '".$this->heading."' succesfull";
			} else{
				$this->message = "Error on insert";
			}
		} else{
			$this->message = "Heading and a short discription is required";
		}
	}

	// edit article
	function edit_article(){
		global $settings, $db_table;
		$db = new Core_Database();
		
		$template = new Core_Template($settings['module_template_dir'].$this->template);
		
		// normal input fields
		if($result = $db->db_row("SELECT * FROM ".$db_table['article']." WHERE art_id = ".$this->id)){
			$button_name = "update";
			$button_value = "Bewaren";
			$this->message = "Editing: '".$result['art_heading']."'";
		} else{
			$button_name = "insert";
			$button_value = "Invoegen";	
		}
		
		$template->placeholder("{button_name}", $button_name);
		$template->placeholder("{button_value}", $button_value);
		
		$template->placeholder("{art_intro}", $result['art_intro']);
		$template->placeholder("{art_keywords}", $result['art_keywords']);		
		$template->placeholder("{art_heading}", $result['art_heading']);
		$template->placeholder("{art_body}", stripslashes($result['art_body']));
		
		// check to set 'active' checkbox
		if($result['art_active'] || $this->id == 0){
			$checked = " checked=\"checked\"";
		} else{
			$checked = false;						
		}		
		$template->placeholder("{art_active}", $checked);
		
		// date pulldown's		
		if($result['art_date_end']){
			$date_end = $result['art_date_end'];
		} else{	
			$date_end = datum_formaat(false, time()+112 * 7 * 24 * 60 * 60, "mysql"); // 2 years exrtra returned as timestamp
		}
		
		//$date_end = date_pulldown();
		$date_end = date_pulldown($date_end);
		$template->placeholder("{end_year}", $date_end['year']);
		$template->placeholder("{end_month}", $date_end['month']);
		$template->placeholder("{end_days}", $date_end['days']);
		$template->placeholder("{end_hour}", $date_end['hour']);
		$template->placeholder("{end_minutes}", $date_end['minutes']);
		$template->placeholder("{end_seconds}", $date_end['seconds']);
		
		
		// cat pulldown
		$cat_clean = $template->getblok("CAT");
		if($cat_list = $db->db_array("SELECT * FROM ".$db_table['cat']." ORDER BY cat_heading")){
			foreach($cat_list as $cat_row){
				$cat = $cat_clean;
				
				// selected if edit
				if($cat_row['cat_id'] == $result['art_cat']){
					$selected = " selected=\"selected\"";
				} else{
					$selected = false;
				}
				$cat = str_replace("{selected}", $selected, $cat);
				
				
				$cat = str_replace("{cat_id}", $cat_row['cat_id'], $cat);
				$cat = str_replace("{cat_heading}", $cat_row['cat_heading'], $cat);
				
				$cat_end .= $cat;
			}			
		}
		$template->placeholder("{CAT}", $cat_end);
		
		
		// article list
		$art_pulldown_clean = $template->getblok("ARTICLE_LIST");
		if($art_list = $db->db_array("SELECT art_postname, art_heading FROM ".$db_table['article']." ORDER BY art_heading")){
			foreach($art_list as $art_pulldown){
				$art_row = $art_pulldown_clean;
				
				$art_row = str_replace("{pulldown_art_postname}", $art_pulldown['art_postname'], $art_row);
				$art_row = str_replace("{pulldown_art_heading}", $art_pulldown['art_heading'], $art_row);
			
				$art_end .= $art_row;			
			}
		}
		$template->placeholder("{ARTICLE_LIST}", $art_end);
		
		
		// image list
		$img_pulldown_clean = $template->getblok("IMG_LIST");
		if($img_list = dir_to_array($settings['require_url'].$settings['atlantis_uploads'], "name")){
			foreach($img_list as $img_pulldown){
				$img_row = $img_pulldown_clean;
								
				$img_row = str_replace("{img_value}", $settings['atlantis_uploads'].$img_pulldown['name'], $img_row);
				$img_row = str_replace("{img_label}", $img_pulldown['name'], $img_row);
			
				$img_end .= $img_row;			
			}
		}
		$template->placeholder("{IMG_LIST}", $img_end);		
		
		// status message
		$template->placeholder("{message}", $this->message); 
		$template->parse();
	} 	
}
?>