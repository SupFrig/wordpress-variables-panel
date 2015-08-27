<?php
	if(isset($_POST) && !empty($_POST)){
		//unset default wordpress params
		unset($_POST['page']);
		unset($_POST['submit']);
		
		foreach($_POST as $key => $entry){
			
			if(strpos($key,'adminvar') == 0){
				$option = get_option($key);
				
				//option not exists, create it
				if($option == false){
					add_option($key,$entry);
				}else{
					update_option($key,$entry);
				}
			}
			
			if(strpos($key,'deleteadminvar_adminvar') === 0){
				$new_key = str_replace('deleteadminvar_','',$key);
				delete_option($new_key);
			}
		}
	}
?>