<script>
$(document).ready(function() {
	$("#LoginButton").click(function() {
		var dLogin = $('input[name=login]').val();
		var dPassword = $('input[name=password]').val();
		
		$.ajax(
		{
			url: "login_verify.php",
			type: "POST",
			data: "login="+dLogin+"&password="+dPassword,
			success: function(phpmessages){
				if(phpmessages == "#UserLoginSuccess")
				{
					$("#LoginForm").slideUp(800, function(){
						location.reload();
					});
				}
				else{
					alert(phpmessages);
				}
			}
		});
	});
	$("#Zapraszamy").click(function(){
		$("#LoginForm").slideDown(800);
		$("#Zapraszamy").css('display','none');
	});
});

</script>