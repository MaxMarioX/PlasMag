<script>
$(document).ready(function() {
	$("#ButtonInstall").click(function() {
		var dHost = $('input[name=Field-host]').val();
		var dUser = $('input[name=Field-user]').val();
		var dPassword = $('input[name=Field-password]').val();
		
		$.ajax(
		{
			url: "data/install_data/part_1.php",
			type: "POST",
			data: "host="+dHost+"&user="+dUser+"&password="+dPassword,
			success: function(status) {
				if(status == "success")
				{
					$("#InstallDataBox").slideUp(800, function() {
						$("#InstallDataBox2").slideDown(800);
					});
				}else{
					alert(status);
				}
			}
		}
		);
	});
	$("#ButtonInstall-2").click(function() {
		var dHost_new = $('input[name=Field-new-host]').val();
		var dUser_new = $('input[name=Field-new-user]').val();
		var dPassword_new = $('input[name=Field-new-password]').val();
		var dDatabase = $('input[name=Field-db-name]').val();
		
		$.ajax(
		{
			url: "data/install_data/part_2.php",
			type: "POST",
			data: "nhost="+dHost_new+"&nuser="+dUser_new+"&npassword="+dPassword_new+"&ndatabase="+dDatabase,
			success: function(status) {
				if(status == "success")
				{
					$("#InstallDataBox2").slideUp(800, function() {
						$('#InstallDataBox3').slideDown(800);
					});
				}else{
					alert(status);
				}
			}
		}
		);
	});
	$("#ButtonInstall-3").click(function() {
		var user_name = $('input[name=Field-user-name]').val();
		var user_password = $('input[name=Field-user-password]').val();
		var user_password_2 = $('input[name=Field-new-password-2]').val();
		
		$.ajax (
		{
			url: "data/install_data/part_3.php",
			type: "POST",
			data: "sysUser="+user_name+"&sysPassword="+user_password+"&sysPassword2="+user_password_2,
			success: function(status) {
				if(status == "success")
				{
					$("#InstallDataBox3").slideUp(800, function() {
						$('#InstallDataBox5').slideDown(800);
					});
				}else{
					alert(status);
				}				
			}
		}
		);
	});
	$("#ButtonInstall-5").click(function() {
		
		$.ajax (
		{
			url: "data/install_data/database_install.php",
			type: "POST",
			success: function(status) {
				if(status == "#success")
				{
					alert("Instalacja zakończyła się powodzeniem.");					
					$("#InstallDataBox5").slideUp(800);
					location.reload();
				}else{
					alert(status);
				}				
			}
		}
		);
	});
});
</script>