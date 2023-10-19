'use strict'

$(document).ready(function()
{
	const loginText = document.querySelector(".title-text .login");
	const loginForm = document.querySelector("form.login");
	const loginBtn = document.querySelector("label.login");
	const signupBtn = document.querySelector("label.signup");
	signupBtn.onclick = (()=>{
		loginForm.style.marginLeft = "-50%";
		loginText.style.marginLeft = "-50%";
	});
	loginBtn.onclick = (()=>{
		loginForm.style.marginLeft = "0%";
		loginText.style.marginLeft = "0%";
	});

	$('#login-form').on('submit', function(e)
	{
		e.preventDefault();
		var formData = $('#login-form').serializeArray();
		
		var login = formData[0]['value'];
		var password = formData[1]['value'];

		$.ajax({
			type: 'POST',
			data: { login: login, password: password },
			url: '/php/scripts/signin.php',
			success: function(response)
			{
				if(JSON.parse(response)['Message'] == "Success")
				{
					 window.location.href = "http://localhost/pages/homepage/homepage.php";
					 window.location.replace("http://localhost/pages/homepage/homepage.php");
				}
			}
		});
	});

	$('#signup-form').on('submit', function(e)
	{
		e.preventDefault();
		var formData = $('#signup-form').serializeArray();

		var name = formData[0]['value'];
		var address = formData[1]['value'];
		var city = formData[2]['value'];
		var login = formData[3]['value'];
		var password = formData[4]['value'];

		$.ajax({
			type: 'POST',
			data: { login: login, password: password, name: name, address: address, city: city },
			url: '/php/scripts/signup.php',
			success: function(response)
			{
				if(JSON.parse(response)['Message'] == "Success")
				{
					window.location.href = "http://localhost/pages/homepage/homepage.php";
					window.location.replace("http://localhost/pages/homepage/homepage.php");
				}else{
					alert("Ты куда лезешь?");
				}
			}
		});
	});
});