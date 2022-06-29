<?php
//login_box.php - zawiera formularz logowania w języku html
	$ShowLoginBox = '
		<!--Tworzenie obszaru do logowania użytkownika-->
		<div class="WelcomeButton">
			<input type="button" name="Zapraszamy" id="Zapraszamy" value="Kliknij aby rozpocząć..."/>
		</div>
		<div class="LoginForm" id="LoginForm">
			<!--Miejsce na wyświetlenie obrazka-->
			<!--<div class="ImageBox"></div>-->
			<!--Miejsce na wyświetlenie pól i przycisku-->
			<div class="LoginDataBox" id="LoginDataBox">
				<div class="WelcomeText">
				<h1>PLAS-MAG</h1>
				<p>Witamy! Proszę podać poprawny login i hasło aby rozpocząć pracę z aplikacją.</p>
				</div>
				<!--Formularz, który zostanie przesłany do login.php-->
				<form method="post" action="">
					<!--Tworzenie pól i przycisku do logowania-->
					<div class="LoginData">
						<span><i class="fa fa-user" aria-hidden="true"></i></span>
						<input type="text" name="login" id="login" placeholder="Nazwa użytkownika"/>
					</div>
					<div class="LoginData">
						<span><i class="fa fa-lock" aria-hidden="true"></i></span>
						<input type="password" name="password" id="password" placeholder="Hasło"/>
					</div>
						<input type="button" name="LoginButton" id="LoginButton" value="Zaloguj się"/>
				</form>
			</div>
		</div>	
	';
	echo $ShowLoginBox;
?>