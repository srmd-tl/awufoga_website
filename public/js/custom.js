/*Call ajax to send get request to server to fetch sub categories against a category*/
	function getData(url) {

		  return new Promise((resolve, reject) => {
		   $.get(url)
		      .done(function(response) {
		        resolve(response)
		      })
		      .fail(function(error) {
		       reject(error)
		      })
		  })

	
	}

$(function(){

	//ON page load 
	defaultOptions()

	//Category Filter On change handler
	$("select[name='categoryFilter']").change(function(){
		url = "/ajax/subCategories/"+$(this).val()
	    getData(url)
        .then(data=>{
          dynamicOptions($("select[name='subCategoryFilter']"),data)
        })
	})


	/*Functions*/

	

	/*Dynamic Option Generation*/
	 function dynamicOptions(selector,data)
	 {
	     selector.html("")

	     if((selector.attr("name")=="categoryFilter")||(selector.attr("name")=="subCategoryFilter"))
	     {
	         $("select[name='subCategoryFilter']").append("<option value='' selected >All</option>")
	        
	     }
	     

	     if(data.length >0)
	     {

	         $.each(data,function(key,val){
	             selector.append("<option value="+val.id+" >"+val.name+"</option>")
	         })
	     }
	     else
	     {    selector.attr('disabled')
	          selector.append("<option selected='selected' value='none' >None</option>")
	     }
	 
	 }

	 /*Default Options on page load*/
	 function defaultOptions() {
	 	url = "/ajax/subCategories/"+$("select[name='categoryFilter']").val()
	    getData(url)
        .then(data=>{
          dynamicOptions($("select[name='subCategoryFilter']"),data)
        })
	 }
})