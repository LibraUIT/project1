$(window).bind("load", function() {
	$(function(){
		if(localStorage.getItem("isAdminLogin"))
		{
			window.location.href = base_url + "admin/admin.html";
		}
		$('#submit-admin-login').on('click', function(){
			$('#message-login-error').css({"display":"none"});
			var u_email = $('#u_email').val();
			var u_password = $('#u_password').val();
			if(u_email.length > 1)
			{
				var valiEmail = validateEmail(u_email);
				if(valiEmail === false)
				{
					$('#message-login-error span').text(lang.text_login_form_message_error_email_validate);
					$('#message-login-error').css({"display":"block"});
				}else
				{
					if(u_password.length > 1)
					{
						$.ajax({
								method: "POST",
								url: [base_url, 'admin', 'login_submit'].join('/'),
								data: {email : u_email, password : u_password }
							}).done(function( result ) {
								if(result == "FALSE")
								{
									$('#message-login-error span').text(lang.text_login_form_message_error_login);
									$('#message-login-error').css({"display":"block"});
								}else
								{
									$id = result['u_id'];
									localStorage.setItem("isAdminpass", result['u_password']);
									localStorage.setItem("isAdminemail", result['u_email']);
									localStorage.setItem("isAdminLogin", $id  );

									window.location.href = base_url + "admin/admin.html";
								}			   
						});
					}else
					{
						$('#message-login-error span').text(lang.text_login_form_message_error_password_required);
						$('#message-login-error').css({"display":"block"});
					}
				}
			}else
			{
				$('#message-login-error span').text(lang.text_login_form_message_error_email_required);
				$('#message-login-error').css({"display":"block"});
			}
 		});
		//When enter key down
		$("#u_email, #u_password, #submit-admin-login").keyup(function(event){
		    if(event.keyCode == 13){
		        $('#message-login-error').css({"display":"none"});
				var u_email = $('#u_email').val();
				var u_password = $('#u_password').val();
				if(u_email.length > 1)
				{
					var valiEmail = validateEmail(u_email);
					if(valiEmail === false)
					{
						$('#message-login-error span').text(lang.text_login_form_message_error_email_validate);
						$('#message-login-error').css({"display":"block"});
					}else
					{
						if(u_password.length > 1)
						{
							$.ajax({
									method: "POST",
									url: [base_url, 'admin', 'login_submit'].join('/'),
									data: {email : u_email, password : u_password }
								}).done(function( result ) {
									if(result == "FALSE")
									{
										$('#message-login-error span').text(lang.text_login_form_message_error_login);
										$('#message-login-error').css({"display":"block"});
									}else
									{
										$id = result['u_id'];
										localStorage.setItem("isAdminpass", result['u_password']);
										localStorage.setItem("isAdminemail", result['u_email']);
										localStorage.setItem("isAdminLogin", $id  );

										window.location.href = base_url + "admin/admin.html";
									}			   
							});
						}else
						{
							$('#message-login-error span').text(lang.text_login_form_message_error_password_required);
							$('#message-login-error').css({"display":"block"});
						}
					}
				}else
				{
					$('#message-login-error span').text(lang.text_login_form_message_error_email_required);
					$('#message-login-error').css({"display":"block"});
				}	
			    }
		});
	})
})
function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}