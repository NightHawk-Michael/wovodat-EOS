function secureimage(){
	$('#siimage').attr('src','../securecheck/securimage_show.php?' + Math.random());
	$('#code').val('');
}
		
		
$(document).ready(function() {


// For wovodat registration page
	$("#form1").validate({
		onkeyup: false,      // Stopping remote validation as you type
		rules: {
			uname: {
				required: true,
				remote: {
					url: "../securecheck/existaccount_m.php",
					type: "POST",
					data: {
						uname: function() {
							return $("#unameReg").val();
						}
					}   
				}	
			},
			password: {
				required: true,
				minlength: 6,
				maxlength: 30
			},
			conf_password: {
				required: true,
				equalTo: "#password",
				minlength: 6,
				maxlength: 30
			},
			email: {
				required: true,
				email: true
			},	
			obs:{
				required: true,
			},
			code:{
				required: true,
				remote: {
					url: "../securecheck/verify.php",
					type: "POST",
					data: {
						code:function(){
							return $("#code").val();
						}
					}
				}
			},
			agree:{
				required: true
			}
		},			
		messages: {
			uname:{
				required: "*Please enter username",
				remote: jQuery.format("*Username is already in use, please choose another one")
			},			
			password: {
				required: "*Please provide a password",
				minlength: "*Your password must be at least 6 characters long",
				maxlength: "*Your password cannot<br/> exceed 30 characters long"
			},
			conf_password: {
				required: "*Please enter the same password as above",
				minlength: "*Your password must be at least 6 characters long",
				maxlength: "*Your password cannot<br/> exceed 30 characters long",
				equalTo: "*Please enter the same password as above"
			},				
			email:{
				required: "*Please enter a valid email address"
			},
			obs:{
				required: "*Please select observatory"
			},			
			code:{
				required: "*Please type the above security code",
				remote: jQuery.format("The code you entered was invalid")
			},
			agree:{
				required: "*Please agree to WOVOdat Privacy Policy"
			}
		},
		// the errorPlacement has to take the table layout into account 
		errorPlacement: function(error, element) { 
			error.appendTo(element.parent().parent());
		},
	});


// For wovodat contact Us page	
	$("#contactUsform").validate({
		onkeyup: false,
		rules: {
			subject: {
				required: true              
			},
			message:{
				required: true     
			},
			name: {
				required: true              
			},
			email: {
				required: true,
				email: true
			},
			code:{
				required: true,
				remote: {
					url: "../securecheck/verify.php",
					type: "POST",
					data: {
						code:function(){
							return $("#code").val();
						}
					}
				}
			}			
		},
		messages: {
			subject: {
				required: "*This field is required"
				
			},
			message: {
				required: "*This field is required"
			},
			name: {
				required: "*This field is required"
			},
			email:{
				required: "*Please enter a valid email address"
			},
			code:{
				required: "*Please type the above security code",
				remote: jQuery.format("The code you entered was invalid")
			}			
			
		}
	});
});			
					
