
function callcity(stateval, cityval){
	$('#city').html('<option value="">Loading...</option>');
	$.ajax({
	  type: "POST", url: 'ajax/ajax.php', data: "stateid="+stateval+"&cityid="+cityval,
	  complete: function(data){  
		  $('#city').html(data.responseText);
		  
	  }
	});
}

function callproject(builder, project){
	$('#project_id').html('<option value="">Loading...</option>');
	$.ajax({
		type: "POST", url: 'ajax/ajax.php', data: "bid="+builder+"&pid="+project+"&type=builder",
		complete:function(data){
			$("#project_id").html(data.responseText);
		}
	});
}

function ajaxCityCall(stateval,selectfield)
{
    $('#city').html('Loading...');
	$.ajax({
	  type: "POST", url: 'http://cdp.indiaproperty.com/ajax/ajaxresponse.php', data: "type=city&stateid="+stateval+"&fieldname=selCity&selectfield="+selectfield,
	  complete: function(data){  
		  $('#city').html(data.responseText);	
		  
	  }
	});
	if(document.getElementById('selLocality'))
		$('#selLocality').find('option').remove().end().append('<option value="">- Select Locality -</option>').val('');
}

function ajaxLocationCall(cityval,selectfield)
{
    $('#location').html('Loading...');
	$("#LocationData tr").remove();	
	$('#errloc').html('');
	if(document.getElementById('divplus'))
	document.getElementById('divplus').style.border ="";
	if(document.getElementById('hdncityid'))
	document.getElementById('hdncityid').value=cityval;	
	$.ajax({
	  type: "POST", url: 'http://cdp.indiaproperty.com/ajax/ajaxresponse.php', data: "type=locality&cityid="+cityval+"&fieldname=selLocation&selectfield="+selectfield,
	  complete: function(data){  
		  $('#location').html(data.responseText);	
           $.ajax({
		   type: "POST", url: 'http://cdp.indiaproperty.com/ajax/ajaxlocality.php', data: "type=locality&cityid="+cityval+"&defid=0",
		   complete: function(data){  
			 $('#preflocation').html(data.responseText);	
			  }
	      });
	  }
	});
	
}

function loadReportingTo(usrtype, rto)
{
   
	$('#errloc').html('');
	$.ajax({
	  type: "POST", url: 'http://cdp.indiaproperty.com/ajax/ajaxresponse.php', data: "type=reporting&usrtype="+usrtype+"&fieldname=selCustomerReportingTo&selectfield="+rto,
	  complete: function(data){  
		  $('#selCustomerReportingTo').html(data.responseText);	
	  }
	});
	
}