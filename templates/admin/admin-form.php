<?php 
$plugin_url = plugin_dir_url( __FILE__ );
$admin_url = admin_url('admin.php?page=export_registration_admin');
$prefix = 'adminvar_';
$options = wp_load_alloptions();
$adminvar_options = array();

foreach($options as $key => $option){
	if(strpos($key,'adminvar') !== false){
		$newkey = str_replace('adminvar_','',$key);
		$adminvar_options[$newkey] = $option;
	}
}

$adminvar_options  = array_reverse($adminvar_options);

?>

<div class="wrap">
	<h2>
		<?php _e('Variables administrables'); ?>
		<a href="#" class="add-new-h2"><?php _e('Ajouter une variable'); ?></a>
	</h2>
	
	<p>
		<?php _e('Ajoutez / supprimez des variables à la volée.'); ?><br/>
		<?php _e('Cliquez sur "Enregistrer les modifications" pour enregistrer définitivement vos modifications'); ?>
	</p>
	
	<form action="<?php echo $admin_url; ?>" method="POST">
		<table class="form-table">
			<tbody>
				<?php foreach($adminvar_options as $key => $option): ?>
				<tr>
					<th scope="row"><label for="blogname"><?php echo $key; ?></label></th>
					<td>
						<input name="adminvar_<?php echo $key; ?>" type="text" id="blogname" value="<?php echo $option; ?>" class="regular-text">
						<a href="#" class="add-new-h2 delete"><?php _e('Supprimer'); ?></a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Enregistrer les modifications">
		</p>
	</form>
</div>