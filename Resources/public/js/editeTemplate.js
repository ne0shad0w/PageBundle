// JavaScript Document

function SaveCode() {
	var code = document.getElementById('html').value ;
	var template = document.getElementById('template').innerHTML ;
	$.ajax({ 
        url: "/admin/page/template/enregistrer",
		method: "POST",
		data: { 'code' : code , 'template' : template},
		cache: false ,
		context: this
     }).done( function(){Success(this);}).fail( function(){Error(this);});

	
}

function Success(){ 
	$(document.getElementById('message')).css( { opacity : 1 , color : 'green' });
	document.getElementById('message').innerHTML = "Enregistrement réussi.";
	$(document.getElementById('message')).animate( { opacity : 0 } ,10000);

}
function Error(){
	$(document.getElementById('message')).css( { opacity : 1 , color : 'red' });
	document.getElementById('message').innerHTML = "Un problème lors de l'enregistrement est survenue.";
}