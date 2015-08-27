<?php  
	/* 
	Plugin Name: Constants admin panel
	Version: 0.1
	Author: Thomas Montet
	Description: Ajoute un panneau d'administration permettant de définir des constantes dans Wordpress
	*/
	$object = new VariablesPanel();

	// Hook for adding admin menus & js include
	add_action('admin_menu',  array($object, 'addMenu'));
	add_action('admin_enqueue_scripts',  array($object, 'includeScripts'));
	
	//This will create [yourshortcode] shortcode
	add_shortcode('registration_form', array($object, 'shortcode'));
	
	class VariablesPanel{

		/**
		 * This will create a menu item under the option menu
		 * @see http://codex.wordpress.org/Function_Reference/add_options_page
		 */
		public function addMenu(){
			add_menu_page('Variables administrables', 'Variables administrables', 'manage_options', 'export_registration_admin', array($this, 'optionPage'));
		}

		/**
		 * This is where you add all the html and php for your option page
		 * @see http://codex.wordpress.org/Function_Reference/add_options_page
		 */
		public function optionPage(){
			include('controllers/admin-form-controller.php');
			include('templates/admin/admin-form.php');
		}
		
		/**
		 * This is where you include javascripts for admin panel
		 * @see http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
		 */
		public function includeScripts($hook){
			if($hook == 'toplevel_page_export_registration_admin'){
				wp_enqueue_script( 'constants-admin-panel', plugins_url( 'constants-admin-panel/js/constants-admin-panel.js' , dirname(__FILE__) ) );
			}
		}

		/**
		 * this is where you add the code that will be returned wherever you put your shortcode
		 * @see http://codex.wordpress.org/Shortcode_API
		 */
		public function shortcode(){
			return include('templates/form.php');
		}
	}
	
	//helper function for front-office
	function get_admin_var($name){
		return get_option('adminvar_'.$name);
	}
?>