$(document).ready(function() {
	$("#rSubmit").click(function() {
		if ($("#rSubmit").is(":disabled") == false) {
			$("#rSubmit").prop("disabled", true);
			$("#rUsername").prop("disabled", true);
			$("#rPassword1").prop("disabled", true);
			$("#lForgot").prop("disabled", true);
			
			var user = $("#rUsername").val(); 
			var passwd = $("#rPassword1").val();
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			$.post('/core/func/api/auth/loginv2.php', {
				username: user,
				passwd: passwd,
				csrf: csrf_token
			})
			.done(function(response) {
				$("#rSubmit").prop("disabled", false);
				$("#rUsername").prop("disabled", false);
				$("#rPassword1").prop("disabled", false);
                $("#lForgot").prop("disabled", false);
				if (response == "error") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Network error. Try again later.</div>");
				}else if (response == "missing-info") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Please fill in all fields.</div>");
				}else if (response == "no-user") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">No user found with this name.</div>");
				}else if (response == "success") {
					window.location.reload();
				}else if (response == "incorrect-password") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Incorrect password specified.</div>");
				}else if (response == "rate-limit") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Please wait a bit...</div>");
				}else if (response == "incorrect-captcha") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">incorrect captcha, please try again.</div>");
				}else{
                    $("#rStatus").html(response);
				}
			})
			.fail(function() {
                $("#rStatus").html("<div class=\"alert alert-danger\">Network error. Try again later.</div>");
			});
		}
	});

    	$("#lForgot").click(function() {
		if ($("#lForgot").is(":disabled") == false) {
			$("#rSubmit").prop("disabled", true);
			$("#rUsername").prop("disabled", true);
			$("#rPassword1").prop("disabled", true);
			$("#lForgot").prop("disabled", true);
			var user = $("#rUsername").val(); 
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			$.post('/core/func/api/auth/forgot.php', {
				username: user,
				csrf: csrf_token
			})
			.done(function(response) {
				$("#rSubmit").prop("disabled", false);
				$("#lForgot").prop("disabled", false);
				$("#rUsername").prop("disabled", false);
				$("#rPassword1").prop("disabled", false);
				console.log(response);
				if (response == "no-user") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">User not found</div>");
				}else if (response == "rate-limit") {
                    $("#rStatus").html("<div class=\"alert alert-danger\">Please wait</div>");
				}else if (response == "success") {
                    $("#rStatus").html("<div class=\"alert alert-success\">This feature is a work in progress...</div>");
				}
			})
			.fail(function() {
                $("#rStatus").html("<div class=\"alert alert-danger\">Reset password request failed.</div>");
			});
		}
	})
});