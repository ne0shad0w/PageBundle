function save_parent( id , parent ){
          	$.ajax({ 
            	url: "/admin/page/parent/update/"+id+"/"+parent , 
				method: "GET",
				cache: false ,
           	}).done( function(){ console.log('save');});
  
}
// JavaScript Document