<?php
//setup.php - instalacja i konfiguracja systemu

	$ShowInstallBox = '
		<!--Tworzenie obszaru do instalacji-->
		<div class="InstallDataBox" id="InstallDataBox">
			<div class="SetBoxOne" id="SetBoxOne">
				<div class="TextInstall">
					<h1>PLAS-MAG instalacja</h1>
					<h2>Dane do konta administratora</h2>
					<p>W celu przeprowadzenia instalacji należy podać poprawne dane do konta znajdującego się na serwerze bazodanowym
					posiadające uprawnienia administratora.</p>
				</div>
				<div class="FieldsInstall">
					<span class="TextDataField">Nazwa hosta:</span></br>
					<input type="text" name="Field-host" id="Field-host"/></br>
					<span class="TextDataField">Nazwa użytkownika:</span></br>
					<input type="text" name="Field-user" id="Field-user"/></br>
					<span class="TextDataField">Hasło:</span></br>
					<input type="password" name="Field-password" id="Field-password"/></br>
					<input type="button" name="ButtonInstall" id="ButtonInstall" value="Przejdź dalej"/>
				</div>
					
			</div>
		</div>
		<div class="InstallDataBox2" id="InstallDataBox2">
			<div class="SetBoxOne" id="SetBoxOne">
				<div class="TextInstall">
					<h1>PLAS-MAG instalacja</h1>
					<h2>Budowanie pliku database_connect.php</h2>
					<p>Plik ten zawiera informacje wymagane do nawiązania połączenia z bazą danych.</p>
				</div>
				<div class="FieldsInstall">
					<span class="TextDataField">Nazwa hosta:</span></br>
					<input type="text" name="Field-new-host" id="Field-new-host"/></br>
					<span class="TextDataField">Nazwa użytkownika:</span></br>
					<input type="text" name="Field-new-user" id="Field-new-user"/></br>
					<span class="TextDataField">Hasło:</span></br>
					<input type="password" name="Field-new-password" id="Field-new-password"/></br>
					<span class="TextDataField">Nazwa dla bazy danych:</span></br>
					<input type="text" name="Field-db-name" id="Field-db-name"/></br></br>
					<input type="button" name="ButtonInstall-2" id="ButtonInstall-2" value="Przejdź dalej"/>
				</div>
			</div>
		</div>
		<div class="InstallDataBox3" id="InstallDataBox3">
			<div class="SetBoxOne" id="SetBoxOne">
				<div class="TextInstall">
					<h1>PLAS-MAG instalacja</h1>
					<h2>Tworzenie konta</h2>
					<p>Stwórz konto administratora aplikacji PLAS-MAG.</p>
				</div>
				<div class="FieldsInstall">
					<span class="TextDataField">Nazwa konta:</span></br>
					<input type="text" name="Field-user-name" id="Field-user-name"/></br>
					<span class="TextDataField">Hasło:</span></br>
					<input type="password" name="Field-user-password" id="Field-user-password"/></br>
					<span class="TextDataField">Powtórz hasło:</span></br>
					<input type="password" name="Field-new-password-2" id="Field-new-password-2"/></br></br>
					<input type="button" name="ButtonInstall-3" id="ButtonInstall-3" value="Przejdź dalej"/>
				</div>
			</div>
		</div>		
		<div class="InstallDataBox5" id="InstallDataBox5">
			<div class="SetBoxOne" id="SetBoxOne">
				<div class="TextInstall">
					<h1>PLAS-MAG</h1>
					<h2>Instalacja gotowa!</h2>
					<p>Wszystkie wymagane informacje zostały zebrane. Kliknij \'Zainstaluj\' aby rozpocząć instalację.</p>
				</div>
				<div class="FieldsInstall">
					<input type="button" name="ButtonInstall-5" id="ButtonInstall-5" value="Zainstaluj"/>
				</div>
			</div>
		</div>
	';
	echo $ShowInstallBox;

?>