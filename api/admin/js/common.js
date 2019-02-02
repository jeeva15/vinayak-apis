function confimationMsg(msg,callback,callbackparam){
    
    $('body').append('<div id="_BodyAlertMsg"><br>'+msg+'<br><input type="button" name="yes" value="Yes" onclick="'+callback+'(\''+callbackparam+'\');$.fancybox.close();">&nbsp;<input type="button" name="no" value="No" onclick="$.fancybox.close()"></div>');
   // $("#_BodyAlertMsg").show();
    $.fancybox({
    'href'		: '#_BodyAlertMsg',
    'transitionIn'	: 'elastic',
    'transitionOut'	: 'elastic',
    'onClosed'	: function() {
            $("#_BodyAlertMsg").remove();
    }
    });
}

function _getBox(url,width,height){
    $.fancybox({
    'href' : url,
    'height' : height,
    'width' : width,
    'autoScale' : false,
    'transitionIn' : 'elastic',
    'transitionOut' : 'elastic',
	'type' : 'iframe',
	'onClosed' : function() {
		
        location.reload();
        return;
    }
    });
   
}

function getCurrentDate(){
        var d = new Date();
        
        var temp_curr_date = d.getDate();
        if(temp_curr_date < 10)
                temp_curr_date = "0"+temp_curr_date;
                
        var temp_curr_month = d.getMonth()+1;
        if(temp_curr_month < 10)
                temp_curr_month = "0"+temp_curr_month;
                
        var temp_curr_year = d.getFullYear();
        var temp_cdate = temp_curr_year+""+temp_curr_month+""+temp_curr_date;
        return Number(temp_cdate);
}

function getCookie(c_name)
{
       var i,x,y,ARRcookies=document.cookie.split(";");
       for (i=0;i<ARRcookies.length;i++) {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name) {
		 return unescape(y);
		}
      }
}

//Add Error Message 
function _AddErr(o,errMsg,errDispId)
{
    o.parentNode.insertBefore
    var errMsgId = "err_"+o.name;
	if(errDispId == '' || errDispId == null){ errDispId=o; }

    if(!document.getElementById(errMsgId)){
        var em = document.createElement('span');
        em.id = errMsgId;
	em.innerHTML = "<br>&nbsp;<span style='color:#FF6100;font-size:12px;'>"+errMsg+"</span>";
        errDispId.parentNode.insertBefore(em,errDispId.nextSibling);
    }
}

//Remove Error Message 
function _RemErr(o){
    var k = "err_"+o.name;   
    if(document.getElementById(k))
    {
        var em=document.getElementById(k);	
        em.parentNode.removeChild(em);
    }
}

// function which allows user to enter only numbers and backspace key

function allowNumeric(e)
{
	if (!e) var e = window.event;
	if(!e.which) key = e.keyCode;
	else key = e.which;	
	if((key>=48)&&(key<=57)||key==8||key==9||key==32||key==45|| key==43||key==39||key==37 ||key==13 ||key==46)
	{
		key=key;
		return true;
	} else
	 {
	  return false;
	 }
}

function email_validation(value)
{
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if(reg.test(value) == false)
    {
	return false;
    }
    else
    {
	return true;
    }
}

// Number to word function
function makeArray(){
	for (i = 0; i<makeArray.arguments.length; i++)
		this[i] = makeArray.arguments[i];
}

function emailValidator(value){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(value.match(emailExp)){
		return true;
	}else{
		return false;
	}
}



var numbers = new makeArray('','one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve', 'thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen');
var numbers10 = new makeArray('','ten','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety');
function toWords(input,inputId){
	var rupees = Math.floor(input);
	var paise = Math.round((input*100 - rupees*100));
	var thousands = (rupees - rupees % 1000) / 1000;
	var lakhs = 0;
	var crores = 0;
	rupees -= thousands * 1000;
	if(thousands > 99){
		lakhs = Math.floor(thousands / 100) ;
		thousands = thousands - lakhs*100;
	}
	if(lakhs > 99){
		crores = Math.floor(lakhs / 100) ;
		lakhs = lakhs - crores*100;
	}
	if(crores > 99){
		document.getElementById(inputId).innerHTML = 'Sorry! Amount Too Long';		
		return false;
		return '';
	}

	var hundreds = (rupees - rupees % 100) / 100;
	rupees -= hundreds * 100;
	var output = '';
	output += (crores > 0 ? fN(crores) + ' Crore ' : '') + ((( lakhs >0 || thousands > 0 || hundreds > 0 || rupees > 0 || paise > 0
               ) && crores > 0) ? 'and ' : '') + (lakhs > 0 ? fN(lakhs) + ' Lakh ' : '') + (thousands > 0 ? fN(thousands) + ' thousand ' : '') +
               (hundreds > 0 ? fN(hundreds) + ' hundred ' : '') + (rupees > 0 ? fN(rupees) + ' ' : '') + ((lakhs >0 || thousands > 0 || hundreds > 0 || rupees > 0) ? 'rupees ' : '') +
                ((Math.floor(input) > 0 && paise > 0) ? 'and ' : '') + (paise > 0 ? fN(paise) + ' paise' : '');

	document.getElementById(inputId).innerHTML = output.substring(0,1).toUpperCase() + output.substring(1);
	if(document.frmAnswer.chkSameBudget)
	{
	  if(document.frmAnswer.chkSameBudget.checked)
	  {
	    document.getElementById(inputId).innerHTML='About '+document.getElementById(inputId).innerHTML;
	  }
	  
	}
}

function fN(i){
	if (i<20) return numbers[i];
	var tens = (i - i % 10) / 10, units = i - (i - i % 10);
	return numbers10[tens] + ((tens > 0 && units > 0) ? '-' : '') + numbers[units];
}
// End Number to word function

function toWordsOnly(input,inputId){
	var rupees = Math.floor(input);
	var paise = Math.round((input*100 - rupees*100));
	var thousands = (rupees - rupees % 1000) / 1000;
	var lakhs = 0;
	var crores = 0;
	rupees -= thousands * 1000;
	if(thousands > 99){
		lakhs = Math.floor(thousands / 100) ;
		thousands = thousands - lakhs*100;
	}
	if(lakhs > 99){
		crores = Math.floor(lakhs / 100) ;
		lakhs = lakhs - crores*100;
	}
	if(crores > 99){
		document.getElementById(inputId).innerHTML = 'Sorry! Sqft Too Long';		
		return false;
		return '';
	}

	var hundreds = (rupees - rupees % 100) / 100;
	rupees -= hundreds * 100;
	var output = '';
	output += (crores > 0 ? fN(crores) + ' Crore ' : '') + ((( lakhs >0 || thousands > 0 || hundreds > 0 || rupees > 0 || paise > 0
               ) && crores > 0) ? 'and ' : '') + (lakhs > 0 ? fN(lakhs) + ' Lakh ' : '') + (thousands > 0 ? fN(thousands) + ' thousand ' : '') +
               (hundreds > 0 ? fN(hundreds) + ' hundred ' : '') + (rupees > 0 ? fN(rupees) + ' ' : '') + ((lakhs >0 || thousands > 0 || hundreds > 0 || rupees > 0) ? 'sqft ' : '') +
                ((Math.floor(input) > 0 && paise > 0) ? 'and ' : '') + (paise > 0 ? fN(paise) + '' : '');

	document.getElementById(inputId).innerHTML = output.substring(0,1).toUpperCase() + output.substring(1);
	
	if(document.frmAnswer.chkSameSfeet)
	{
	  if(document.frmAnswer.chkSameSfeet.checked)
	  {
	    document.getElementById(inputId).innerHTML='About '+document.getElementById(inputId).innerHTML;
	  }
	  
	}
	
}


function toWordsNoAbout(input,inputId){
	var rupees = Math.floor(input);
	var paise = Math.round((input*100 - rupees*100));
	var thousands = (rupees - rupees % 1000) / 1000;
	var lakhs = 0;
	var crores = 0;
	rupees -= thousands * 1000;
	if(thousands > 99){
		lakhs = Math.floor(thousands / 100) ;
		thousands = thousands - lakhs*100;
	}
	if(lakhs > 99){
		crores = Math.floor(lakhs / 100) ;
		lakhs = lakhs - crores*100;
	}
	if(crores > 99){
		document.getElementById(inputId).innerHTML = 'Sorry! Amount Too Long';		
		return false;
		return '';
	}

	var hundreds = (rupees - rupees % 100) / 100;
	rupees -= hundreds * 100;
	var output = '';
	output += (crores > 0 ? fN(crores) + ' Crore ' : '') + ((( lakhs >0 || thousands > 0 || hundreds > 0 || rupees > 0 || paise > 0
               ) && crores > 0) ? 'and ' : '') + (lakhs > 0 ? fN(lakhs) + ' Lakh ' : '') + (thousands > 0 ? fN(thousands) + ' thousand ' : '') +
               (hundreds > 0 ? fN(hundreds) + ' hundred ' : '') + (rupees > 0 ? fN(rupees) + ' ' : '') + ((lakhs >0 || thousands > 0 || hundreds > 0 || rupees > 0) ? 'rupees ' : '') +
                ((Math.floor(input) > 0 && paise > 0) ? 'and ' : '') + (paise > 0 ? fN(paise) + ' paise' : '');

	document.getElementById(inputId).innerHTML = output.substring(0,1).toUpperCase() + output.substring(1);
	if(document.frmAnswer.chkSameBudget)
	{
	  if(document.frmAnswer.chkSameBudget.checked)
	  {
	    document.getElementById(inputId).innerHTML=''+document.getElementById(inputId).innerHTML;
	  }
	  
	}
}


