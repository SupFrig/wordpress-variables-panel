

jQuery(document).ready(function(){
	clickAddAction();
	clickDeleteAction();
});

var clickAddAction = function(){
	var varTable = jQuery('.form-table');
	jQuery('h2 .add-new-h2').on('click',function(){
		if(!jQuery('.new-var-name').length){
			var newLine = emptyLineStep1();
			varTable.prepend(newLine);
			clickNextStepAction();
		}else{
			alert('La déclaration de la dernière variable n\'est pas terminée, veuillez renseigner un nom de variable et cliquez sur "Valider le nom de la variable"');
		}
	});
}

var clickNextStepAction = function(){
	jQuery('.var-next-step').on('click',function(){
		var $this = jQuery(this),
		currentTr = $this.closest('.add');
		varName = $this.closest('tr').find('.new-var-name').val();
		
		//TODO : check if varName is a secure machine name
		var newLine = emptyLineStep2(varName);
		currentTr.after(newLine);
		currentTr.remove();
	});
}

var clickDeleteAction = function(){
	var varTable = jQuery('.form-table');
	jQuery('.delete').on('click',function(){
		
		var $this = jQuery(this),
		currentTr = $this.closest('tr'),
		varName = currentTr.find('input').attr('name'),
		hiddenField = hiddenDeleteField(varName);
		
		currentTr.remove();
		varTable.append(hiddenField);
	});
}

var emptyLineStep1 = function(){
	return '<tr class="add"><th><input type="text" class="new-var-name" value=""></th><td><a href="#" class="button button-primary var-next-step">Valider le nom de la variable</a></td></tr>';
}

var emptyLineStep2 = function(varName){
	return '<tr><th scope="row"><label for="blogname">'+varName+'</label></th><td><input name="adminvar_'+varName+'" type="text" value="" class="regular-text"></td></tr>';
}

var hiddenDeleteField = function(varName){
	return '<input type="hidden" name="deleteadminvar_'+varName+'" value="1"/>';
}