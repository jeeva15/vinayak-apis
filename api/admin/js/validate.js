$(document).ready(function(){
	
var jv = {
	'is_empty_withCond' : function(o,conditn,msg,req){
		console.log("conditn",conditn);
		if(req == false && conditn == false){ return true; }		
		var re = /\s/g; 
		RegExp.multiline = true;
		var str = o.val().replace(re, "");
		if (str.length == 0 && conditn == true) {
			jv.errors = true;
			DispErr(o,msg);
			return false;
		}
		else{
			RemoveErr(o);
			return true;
		}
	},
	'is_empty' : function(o,msg,req){
		if(req == false){ return true; }		
		var re = /\s/g; 
		RegExp.multiline = true;
		var str = o.val().replace(re, "");
		if (str.length == 0) {
			jv.errors = true;
			DispErr(o,msg);
			return false;
		}
		else{
			RemoveErr(o);
			return true;
		}
	},
	
	'is_email' : function(o,msg,req){
		if(!req){ if(o.val() == ''){ RemoveErr(o); return true;	} }
		
		var patt = /^.+@.+[.].{2,}$/i;		
		if(!patt.test(o.val())) {
			jv.errors = true;
			DispErr(o,msg);
			return false;
		}
		else{
			RemoveErr(o);
			return true;
		}
	},

	'is_number' : function(o,msg,req){
		if(!req){ if(o.val() == ''){ RemoveErr(o); return true;	} }

		if(!(/^\d+$/.test(o.val()))){
			jv.errors = true;
			DispErr(o, msg);
			return false;
		}else{
			RemoveErr(o);
			return true;
		}
	},
	'is_positive_number' : function(o,msg,req){
		if(!req){ if(o.val() == ''){ RemoveErr(o); return true;	} }

		if(Number(o.val) < 0){
			
			jv.errors = true;
			DispErr(o, msg);
			return false;
		}else{
			RemoveErr(o);
			return true;
		}
	},

	'is_float' : function(o,msg,req){
		if(!req){ if(o.val() == ''){ RemoveErr(o); return true;	} }

		if(!(/^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(o.val()))){
			jv.errors = true;
			DispErr(o, msg);
			return false;
		}else{
			RemoveErr(o);
			return true;
		}
	},

	'is_alpha' : function(o,msg,req){
		if(!req){ if(o.val() == ''){ RemoveErr(o); return true;	} }
		var patt = /[0-9\_\-\\*\&\^\%\$\#\@\!\~]/i;		
		if(patt.test(o.val())) {
			jv.errors = true;
			DispErr(o,msg);
			return false;
		}
		else{
			RemoveErr(o);
			return true;
		}
	},
	
	'is_url' : function(o,msg,req){
		if(!req){ if(o.val() == ''){ RemoveErr(o); return true;	} }
		var patt = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
		if(!patt.test(o.val())) {
			jv.errors = true;
			DispErr(o,msg);
			return false;
		}
		else{
			RemoveErr(o);
			return true;
		}
	},
	'is_either3' : function(o,msg,req){
		var val = o.val();		
		var id = val.split(',');
		if($('#'+id[0]).val() == '' && $('#'+id[1]).val() == '' && $('#'+id[2]).val() == '')
		{
			jv.errors = true;
			DispErr($('#'+id[2]),msg);
			return false;
		}
		else{
			RemoveErr($('#'+id[2]));
			return true;
		}
		
	},
	
	'submit' : function (){
		if(!jv.errors) {
			$('#'+_formId).submit();
		}
		else{
			var targetOffset = $('#'+_formId).offset().top;
			$('html,body').animate({scrollTop: targetOffset}, 1000);
		}
	}
}


var DispErr = function(ele, msg){
	$('body').append('<div id="'+ele.attr('name')+'Info" class="info"></div>');	
	var pos = ele.offset();
	var Info = $('#'+ele.attr('name')+'Info');
	Info.css({
		top: pos.top-3,
		left: pos.left+ele.width()+15
	});
	Info.removeClass('correct').addClass('error').html(msg).show();
	ele.removeClass('normal').addClass('wrong').css({'font-weight': 'normal'});
}
var RemoveErr = function(ele){
	$('body').append('<div id="'+ele.attr('name')+'Info" class="info"></div>');	
	var pos = ele.offset();
	var Info = $('#'+ele.attr('name')+'Info');
	Info.css({
		top: pos.top-3,
		left: pos.left+ele.width()+15
	});
	Info.removeClass('error').addClass('correct').html('&radic;').hide();
	ele.removeClass('wrong').addClass('normal');
}

var functionsName={
	'empty' : jv.is_empty,
	'select' : jv.is_empty,
	'email' : jv.is_email,
	'number' : jv.is_number,
	'float' : jv.is_float,	
	'alpha' : jv.is_alpha,
	'url' : jv.is_url,
	'either3' : jv.is_either3,
	'positive' : jv.is_positive_number
}
//set onblur function to each element

$._SetElmOnblur = function (){
	
	$.each(toValidateElem, function(id,funcName){
		
		var fn = funcName[0].split(',');
		if(funcName[0] == "either3"){
			var val = $("#"+id).val();		
			var ids = val.split(',');
			$.each(ids, function(i,va){
				$("#"+va).blur(function(){
					$.each(fn, function(i,v){
						var fName = functionsName[v];
						return fName($("#"+id),toDisplayError[v],funcName[1]);	
					});
				})
			});
			return;
		}
		if($("#"+id).attr('readonly') != true){
			$("#"+id).blur(function(){
				$.each(fn, function(i,v){
					var fName = functionsName[v];
					return fName($("#"+id),toDisplayError[v],funcName[1]);	
				});
				
			});
			}		
		
	});
}
$._SetElmOnblur();
$._onClickSubmit = function(){
	jv.errors =false;
	var obj = $.browser.webkit ? $('body') : $('html');
	//obj.animate({ scrollTop: $('#'+_formId).offset().top }, 750, function (){
		$.each(toValidateElem, function(id,funcName){
			
		var fn = funcName[0].split(',');		
			$.each(fn, function(i,v){
				var fName = functionsName[v];
				if($("#"+id).is(":visible")){
					return fName($("#"+id),toDisplayError[v],funcName[1]);
				}
			});		
		});
		jv.submit();
	//});
	return false;
}
//on submit function
$('#'+_submitId).click(function (){
	return $._onClickSubmit();
});


});