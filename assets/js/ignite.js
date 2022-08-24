$(document).ready(function(){

	 $('[id=type]').on('change',function(){
	 	if($(this).val() == 'Sub'){
	 		$('#main').removeAttr('disabled');
	 	}
	 		else{
	 			$('#main').attr('disabled','disabled');
	 		}
	 });

	 // for confirm Delete

	 $('[id=confirmDelete]').on('click',function(){
			var id = $(this).attr('value');
				table = $(this).attr('table');
				func = $(this).attr('func');
				url = base_url();
		var xmlhttp = new XMLHttpRequest();

	    xmlhttp.onreadystatechange = function(){
	    	console.log('true');
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

	          $('.modal-body').html(xmlhttp.responseText);
	          console.log('work');
	        }
	      }

	    xmlhttp.open('GET',url+'ignite/deleteAll/'+table+'/'+func+'/'+id,true);
	    xmlhttp.send();

	});



	 // for confirm Delete block

	$('[id=blockDelete]').on('click',function(){
		var id = $(this).attr('value');
			file = $(this).attr('file');
			url = base_url();
		var xmlhttp = new XMLHttpRequest();

	    xmlhttp.onreadystatechange = function(){
	    	console.log('true');
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

	          $('#block_modal').html(xmlhttp.responseText);
	          console.log('work');
	        }
	      }

	    xmlhttp.open('GET',url+'ignite/deleteBlock/'+file+'/'+id,true);
	    xmlhttp.send();

	});

	// Block Name Check

	$('#spin').hide();

	$('[id=blockName]').on('change',function(){
		var name = $(this).val();
			url = base_url();

		$('#spin').attr('class','fa fa-spinner fa-spin text-ignite');
		$('#spin').show();
		setTimeout(function(){

			$.ajax({
				url: url + 'ignite/checkBlockName',
				method: 'POST',
				data:{
					'name' : name
				},
				success: function(res){
					$('.err_message').html(res);
		          	if(res == ''){
				    	$('#spin').attr('class','fa fa-check text-success');
				    }
				    	else{
				    		$('#spin').attr('class','fa  fa-times-circle-o text-danger');
				    	}
				}
			});

		},3000);
	   
	   	
	    	

		$('[id=fileName]').val(name.replace(/ /g,'_'));
	});

	$('[id=saveBlock]').on('submit',function(){
		if($('.err_message').html() != ''){
			
			$('#blockName').focus();
			return false;
		}
	});

	// -------------- Item Name Check ----------------

	$('#item_spin').hide();

	$('[id=checkuser]').on('change',function(){
		var name = $(this).val();
			url = base_url();
		var xmlhttp = new XMLHttpRequest();

		$('#name_spin').attr('class','fa fa-spinner fa-spin text-ignite');
		$('#name_spin').show();
		setTimeout(function(){
	    xmlhttp.onreadystatechange = function(){
	    	console.log('true');
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

	          	$('.err_msg').html(xmlhttp.responseText);
	          	if(xmlhttp.responseText == ''){
			    	$('#name_spin').attr('class','fa fa-check-square-o text-success');
			    }
			    	else{
			    		$('#name_spin').attr('class','fa fa-remove text-danger');
			    	}
	        }
	    }

	    xmlhttp.open('GET',url+'ignite/checkUserName/'+name,true);
	    xmlhttp.send();
		},3000);
	   
	});

	$('[id=save_user]').on('submit',function(){
		if($('.err_msg').html() != ''){
			
			$('#checkuser').focus();
			return false;
		}
	});

	// ------------------------------------------


	// -------------- Image Browse ----------------

	// $('#browse').on('change',function(){
	// 	alert('work');
	// 	$('#myUpload').removeClass('disabled');
	// });

	$('[id=thumb]').on('click',function(){
		$('#open').attr('src',$(this).attr('src'));
		$('#open').removeClass('disabled');
		$('.thumb').css({'background':'#fff','color':'#747474'});
		$(this).css({'background':'rgba(51, 51, 51, 0.68) none repeat scroll 0% 0%','color':'#eee'});
	});

	$('#open').on('click',function(){
		var src = $(this).attr('src');
			baseSrc = base_url();
			useImage(baseSrc+src);
	});

	$('[id=thumb]').dblclick(function(){
		var src = $(this).attr('src');
			baseSrc = base_url();
			useImage(baseSrc+src);
	});

	$('[id=pagination]').on('click',function(){
		var start = $(this).attr('start');
			url = base_url();
		var xmlhttp = new XMLHttpRequest();

	    xmlhttp.onreadystatechange = function(){
	    	console.log('true');
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

	          $('#img_thumb').html(xmlhttp.responseText);
	        }
	      }

	    xmlhttp.open('GET',url+'ignite/showImg/'+start,true);
	    xmlhttp.send();
	});


});

// Base Url Function

function base_url(){
	return "https://" + location.hostname + "/";
}

// function base_url(){
// 	return "http://" + location.hostname + "/msp_v4/";
// }


// **************** Image Preview Function ****************

function readURL(input) {
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function (e) 
        {
            $('#blah')
                .attr('src', e.target.result)
                .css('width','100%');
        };

        reader.readAsDataURL(input.files[0]);
    }
}


// Use image and overgive image src to ckeditor

function useImage(imgSrc) {
    function getUrlParam( paramName ) {
        var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' ) ;
        var match = window.location.search.match(reParam) ;

        return ( match && match.length > 1 ) ? match[ 1 ] : null ;
    }
    // var funcNum = getUrlParam( 'CKEditorFuncNum' );
    // var funcNum = null;
    var imgSrc = imgSrc;
    var fileUrl = imgSrc;
    window.opener.CKEDITOR.tools.callFunction( 1, fileUrl );
    window.close();
}

// Drag And Drop

// ondragover
function allowDrop(ev) {
    ev.preventDefault();
}

// ondragstart
function drag(ev) {
    ev.dataTransfer.setData("dragId", ev.target.id);
}

// ondrop
function drop(ev, target) {
    ev.preventDefault();
    var dragId = ev.dataTransfer.getData("dragId");
    	dropId = target.id;
    	url = base_url();
    

    var xmlhttp = new XMLHttpRequest();

	    xmlhttp.onreadystatechange = function(){
	    	console.log('true');
	        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

	          $('.menu-structure').html(xmlhttp.responseText);
	          console.log('work');
	        }
	      }

	    xmlhttp.open('GET',url+'ignite/changeLink/'+dragId+'/'+dropId,true);
	    xmlhttp.send();
}

