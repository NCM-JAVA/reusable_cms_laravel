function getAjaxObject(){

	try{

		// Opera 8.0+, Firefox, Safari

		ajaxRequest = new XMLHttpRequest();

	} catch (e){

		// Internet Explorer Browsers

		try{

			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");

		} catch (e) {

			try{

				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");

			} catch (e){

				// Something went wrong

				alert("Your browser doesn't suppport Ajax!");

				return false;

			}

		}

	}

	return ajaxRequest;

}



function disableErrorLable(val,errLable){

	//alert(val);

	//alert(errLable)

	if(val!=''){

		document.getElementById(errLable).innerHTML='';

	}	

}



function validateGoSmartCart(baseurl){

	var email_check = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	var alpha_num_check = /^([a-zA-Z0-9\s])+$/;

	var alpha_check = /^([a-zA-Z\.\s])+$/;

	var phone_check= /\(?\d{2}\)?([-\/\.])\d{3}\1\d{4}/;

	var website_check= /^(http|ftp):\/\/(www\.)?.+\.(com|net|org)$/;

	var address_check = /^[0-9A-Za-z ,\/.-]+$/;

	var dob='';

	var numbers = /^[0-9]+$/; 

	var phoneno = /^\d{10}$/;

	error = '';

	if(document.getElementById('cardNumber').value!=''){

		var cardNumber = document.getElementById('cardNumber').value;

	}else{

		var cardNumber = '';

	}

	if(cardNumber.length < 10 && cardNumber!=''){

		document.getElementById('cardNumberError').innerHTML='Please enter 10 digit GoSmart card number';

		error	=	true;

	}else if(!numbers.test(document.getElementById('cardNumber').value) && document.getElementById('cardNumber').value!=''){

		document.getElementById('cardNumberError').innerHTML='Please enter only numeric value';

		error	=	true;

	}else if(cardNumber == ''){

		document.getElementById('cardNumberError').innerHTML='Please enter GoSmart card number';

		error	=	true;

	}else if(cardNumber.length > 16 && cardNumber!=''){

		document.getElementById('cardNumberError').innerHTML='GoSmart card number can not be greater than 16 digit';

		error	=	true;

	}

	

	if(document.getElementById('fullname').value==''){

		document.getElementById('fullnameError').innerHTML='Please enter your name';

	}else if(!alpha_check.test(document.getElementById('fullname').value) && document.getElementById('fullname').value!=''){

		document.getElementById('fullnameError').innerHTML='Please enter only characters';

		error	=	true;

	}

	

	

	var str = document.getElementById('mobileNumber').value;

	var index = str.indexOf("0");

	if(document.getElementById('mobileNumber').value==''){

		document.getElementById('mobileNumberError').innerHTML='Please enter your mobile number';

	}else if(!phoneno.test(document.getElementById('mobileNumber').value) && document.getElementById('mobileNumber').value!=''){

		document.getElementById('mobileNumberError').innerHTML='Please enter only numeric value';

		error	=	true;

	}else if(index == 0){

		document.getElementById('mobileNumberError').innerHTML='Please enter a 10 digit mobile number without preceding zeros or country codes';

		error	=	true;

	}

	

	if(!email_check.test(document.getElementById('emailAddress').value) && document.getElementById('emailAddress').value!=''){

		document.getElementById('emailAddressError').innerHTML='Please enter your email in proper format';

		error	=	true;

	}

	

	if(error == false){

		if(document.getElementById('fullname').value!=''){

			var fullname = document.getElementById('fullname').value;

		}else{

			var fullname = 0;

		}

		

		if(document.getElementById('mobileNumber').value!=''){

			var mobileNumber = document.getElementById('mobileNumber').value;

		}else{

			var mobileNumber = 0;

		}

		

		if(document.getElementById('emailAddress').value!=''){

			var emailAddress = document.getElementById('emailAddress').value;

		}else{

			var emailAddress = 0;

		}

		

		if(document.getElementById('gender').value!=''){

			var gender = document.getElementById('gender').value;

		}else{

			var gender = 0;

		}

		

		if(document.getElementById('occupation').value!=''){

			var occupation = document.getElementById('occupation').value;

		}else{

			var occupation = 0;

		}

		

		if(document.getElementById('dateOfBirth').value!=''){

			var dateOfBirth = btoa(document.getElementById('dateOfBirth').value);

		}else{

			var dateOfBirth = 0;

		}



		if(document.getElementById('m_status').value!=''){

			var m_status = document.getElementById('m_status').value;

		}else{

			var m_status = 0;

		}

		

		if(document.getElementById('marriageAniversayr').value!=''){

			var marriageAniversayr = btoa(document.getElementById('marriageAniversayr').value);

		}else{

			var marriageAniversayr = 0;

		}

		

		$("#wait").modal('show');

		var reqVal = baseurl+"Passengerinfo/addGosmartDetail/"+cardNumber+"/"+fullname+"/"+mobileNumber+"/"+emailAddress+"/"+gender+"/"+occupation+"/"+dateOfBirth+"/"+m_status+"/"+marriageAniversayr;

		//alert(reqVal);

		$.ajax({

			url:reqVal,

			type:'GET',

			async: false,

			cache: true,

		})

		

		.done(function(result){	//alert(result);

			if(result == '1'){

				document.getElementById('cardNumber').value = '';

				document.getElementById('fullname').value = '';

				document.getElementById('mobileNumber').value = '';

				document.getElementById('emailAddress').value = '';

				document.getElementById('gender').value = '';

				document.getElementById('occupation').value = '';

				document.getElementById('dateOfBirth').value = '';

				document.getElementById('m_status').value  = '';

				document.getElementById('marriageAniversayr').value = '';

				$("#wait").modal('hide');

				$("#success").modal('show');

			}

			

			if(result == '0'){

				$("#wait").modal('hide');

				$("#error").modal('show');

			}

			

			if(result == '-2'){

				$("#wait").modal('hide');

				$("#invalid").modal('show');

			}

			

			if(result == '-1'){

				$("#wait").modal('hide');

				$("#exist").modal('show');

			}

		})

	}else{ 

		return false;

	}

}



function getFare(baseURL){

	var from = document.getElementById('from').value;

	var to = document.getElementById('to').value;

	if(from == ''){

		document.getElementById('fromError').style.display = 'block';

	}

	if(from != ''){

		document.getElementById('fromError').style.display = 'none';

	}

	if(to == ''){

		document.getElementById('toError').style.display = 'block';

	}

	if(to != ''){

		document.getElementById('toError').style.display = 'none';

	}

	var reqVal = baseURL+"Passengerinfo/getFare/"+from+"/"+to;

	$.ajax({

		url:reqVal,

		type:'GET',

		async: false,

		cache: true,

	})

	.done(function(result){	var result = $.parseJSON(result); //console.log(result.fare);

		if(result!=''){

			document.getElementById('recFare').innerHTML = result.fare;

			document.getElementById('recNoStation').innerHTML = result.noofstation;

			var statArr = '';

			if(result.betweenstation == "No Stations In Between"){

				statArr = result.betweenstation;

			}else{

				var stations = result.betweenstation.split(',');

				for(var k=0;k<stations.length;k++){

					statArr = statArr+(k+1)+'. '+stations[k]+"<br>";

				}

			}

			document.getElementById('recBetweenStation').innerHTML = statArr;

			$("#fare").modal('show');	

		}

	})

}



function getFareStation(baseURL){

	var from = document.getElementById('from').value;

	var reqVal = baseURL+"Passengerinfo/getFareStation/"+from;

	$.ajax({

		url:reqVal,

		type:'GET',

		async: false,

		cache: true,

	})

	.done(function(result){	//alert(result);

		if(result!=''){

			document.getElementById('fareDivStation').innerHTML = result;

		}

	})

}



function sendMessage(){

	

	var email_check = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	var alpha_num_check = /^([a-zA-Z0-9\s])+$/;

	var alpha_check = /^([a-zA-Z\.\s])+$/;

	var phone_check= /\(?\d{2}\)?([-\/\.])\d{3}\1\d{4}/;

	var website_check= /^(http|ftp):\/\/(www\.)?.+\.(com|net|org)$/;

	var address_check = /^[0-9A-Za-z ,\/.-]+$/;

	var dob='';

	var numbers = /^[0-9]+$/; 

	var phoneno = /^\d{10}$/;

	var error = '';

		

	if(document.getElementById('fullname').value==''){

		document.getElementById('fullnameError').innerHTML='Please enter your name';

		error	=	true;

	}else if(!alpha_check.test(document.getElementById('fullname').value) && document.getElementById('fullname').value!=''){

		document.getElementById('fullnameError').innerHTML='Please enter only characters';

		error	=	true;

	}

		

	if(document.getElementById('emailAddress').value==''){

		document.getElementById('emailAddressError').innerHTML='Please enter email address';

		error	=	true;

	}else if(!email_check.test(document.getElementById('emailAddress').value) && document.getElementById('emailAddress').value!=''){

		document.getElementById('emailAddressError').innerHTML='Please enter your email in proper format';

		error	=	true;

	}

    

    if(document.getElementById('confemailAddress').value==''){

		document.getElementById('cemailAddressError').innerHTML='Please enter confirm email address';

		error	=	true;

	}else if(document.getElementById('confemailAddress').value != document.getElementById('emailAddress').value){

		document.getElementById('cemailAddressError').innerHTML='The email address your entered do not match';

		error	=	true;

	}

	

	if(document.getElementById('subject').value==''){

		document.getElementById('subjectError').innerHTML='Please enter Message Subject';

		error	=	true;

	}

	// else if(!alpha_check.test(document.getElementById('subject').value) && document.getElementById('subject').value!=''){

	// 	document.getElementById('subjectError').innerHTML='Please enter only characters';

	// 	error	=	true;

	// }

	

	if(document.getElementById('message').value==''){

		document.getElementById('messageError').innerHTML='Please enter your Message';

		error	=	true;

	  } //else if(!alpha_check.test(document.getElementById('message').value) && document.getElementById('message').value!=''){

	// 	document.getElementById('messageError').innerHTML='Please enter only characters';

	// 	error	=	true;

	// }
 
	

	if(error==false){

		return true;

	}else{ 

		return false;

	}



}



function validateLMM(){

	var email_check = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	var alpha_num_check = /^([a-zA-Z0-9\s])+$/;

	var alpha_check = /^([a-zA-Z\.\s])+$/;

	var phone_check= /\(?\d{2}\)?([-\/\.])\d{3}\1\d{4}/;

	var website_check= /^(http|ftp):\/\/(www\.)?.+\.(com|net|org)$/;

	var address_check = /^[0-9A-Za-z ,\/.-]+$/;

	var dob='';

	var numbers = /^[0-9]+$/; 

	var phoneno = /^\d{10}$/;

	error = '';		



	if(document.getElementById('fullName').value==''){

		document.getElementById('fullNameError').innerHTML='Please enter your name';

		error	=	true;

	}else if(!alpha_check.test(document.getElementById('fullName').value) && document.getElementById('fullName').value!=''){

		document.getElementById('fullNameError').innerHTML='Please enter only characters';

		error	=	true;

	}



	if(document.getElementById('dateOfBirth').value==''){

		document.getElementById('dateOfBirthError').innerHTML='Please select your date of birth';

		error	=	true;

	}



	/*if(document.getElementById('gender').value==''){

		document.getElementById('genderError').innerHTML='Please select your gender';

		error	=	true;

	}*/



	var str = document.getElementById('mobileNumber').value;

	var index = str.indexOf("0");

	if(document.getElementById('mobileNumber').value==''){

		document.getElementById('mobileNumberError').innerHTML='Please enter your mobile number';

	}else if(!numbers.test(document.getElementById('mobileNumber').value) && document.getElementById('mobileNumber').value!=''){

		document.getElementById('mobileNumberError').innerHTML='Please enter only numeric value';

		error	=	true;

	}else if(index == 0){

		document.getElementById('mobileNumberError').innerHTML='Please enter a 10 digit mobile number without preceding zeros or country codes';

		error	=	true;

	}



	if(document.getElementById('emailAddress').value==''){

		document.getElementById('emailAddressError').innerHTML='Please enter your email address';

	}else if(!email_check.test(document.getElementById('emailAddress').value) && document.getElementById('emailAddress').value!=''){

		document.getElementById('emailAddressError').innerHTML='Please enter your email in proper format';

		error	=	true;

	}



	if(!alpha_check.test(document.getElementById('orgName').value) && document.getElementById('orgName').value!=''){

		document.getElementById('orgNameError').innerHTML='Please enter only characters';

		error	=	true;

	}



	if(document.getElementById('idType').value==''){

		document.getElementById('idTypeError').innerHTML='Please select type of ID';

		error	=	true;

	}



	if(document.getElementById('idType').value!=''){

		if(document.getElementById('idNumber').value==''){

			document.getElementById('idNumberError').innerHTML='Please enter '+document.getElementById('idType').value+' number';

			error	=	true;		

		}	

		/*var idNumberLength = document.getElementById('idNumber').value;

		if(idNumberLength.length < 6 && idNumberLength!=''){

			document.getElementById('idNumberError').innerHTML='ID Number should greater of equal to 6 digit.';

			error	=	true;

		}	*/

	}



	if(document.getElementById('cardNumber').value!=''){

		var cardNumber = document.getElementById('cardNumber').value;

	}else{

		var cardNumber = '';

	}

	if(cardNumber.length < 10 && cardNumber!=''){

		document.getElementById('cardNumberError').innerHTML='Please enter 10 digit GoSmart card number';

		error	=	true;

	}else if(!numbers.test(document.getElementById('cardNumber').value) && document.getElementById('cardNumber').value!=''){

		document.getElementById('cardNumberError').innerHTML='Please enter only numeric value';

		error	=	true;

	}else if(cardNumber == ''){

		document.getElementById('cardNumberError').innerHTML='Please enter GoSmart card number';

		error	=	true;

	}else if(cardNumber.length > 16 && cardNumber!=''){

		document.getElementById('cardNumberError').innerHTML='GoSmart card number can not be greater than 16 digit';

		error	=	true;

	}



	/*if(document.getElementById('slogan').value==''){

		document.getElementById('sloganError').innerHTML='Please enter your slogan';

	}*/

	/*if(document.getElementById('yes').checked == true){

		if(document.getElementById('cardNumber').value!=''){

			var cardNumber = document.getElementById('cardNumber').value;

		}else{

			var cardNumber = '';

		}

		if(cardNumber.length < 10 && cardNumber!=''){

			document.getElementById('cardNumberError').innerHTML='Please enter 10 digit GoSmart card number';

			error	=	true;

		}else if(!numbers.test(document.getElementById('cardNumber').value) && document.getElementById('cardNumber').value!=''){

			document.getElementById('cardNumberError').innerHTML='Please enter only numeric value';

			error	=	true;

		}else if(cardNumber == ''){

			document.getElementById('cardNumberError').innerHTML='Please enter GoSmart card number';

			error	=	true;

		}else if(cardNumber.length > 16 && cardNumber!=''){

			document.getElementById('cardNumberError').innerHTML='GoSmart card number can not be greater than 16 digit';

			error	=	true;

		}	

	}*/



	if(error == false){



	}else{ 

		return false;

	}

}

function check_extension(id){
var filename = document.getElementById("attachment").value;
var re = /(\.txt)$/i;
if (!re.exec(filename)) {
	document.getElementById('attachmentError').innerHTML='Only text file allowed!';
  	document.getElementById("attachment").value = "";
}
else{
	document.getElementById('attachmentError').innerHTML='';
}
}