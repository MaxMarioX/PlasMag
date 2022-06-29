<?php
/*
panel_box.php - zawiera kod panelu
*/
//@session_start();

$ShowPanelBox = '
	
	<div class="MainPanelWindow">
		<div class="PanelMenu">
			<!-- Menu harmonijkowe -->
			<div id="PanelAccordion">
				<div class="PanelAccordionHeader">
					<h2 style="color: #FFF">PLAS-MAG PANEL</h2>
					<span></span>
				</div>
				<div class="PanelAccordionHeader">
				
					<h2>Konto</h2>
					<span></span>
				</div>
				
				<ul class="PanelAccordionContent">
					<li class="p_change_password"><a href=\'#\'> Zmień hasło</a></li>
					<li class="p_user_data"><a href=\'#\'>Dane konta</a></li>
					<li class="p_logout"><a href=\'#\'>Wyloguj ['.$_SESSION['UserLogin'].']</a></li>
				</ul>
';   
				
				if($_SESSION['UserPrivileges'] == 1){
					
					$ShowPanelBox .= '
					<div class="PanelAccordionHeader">
						<h2>Pracownicy</h2>
						<span></span>
					</div>
				
					<ul class="PanelAccordionContent">
						<li class="p_new_account"><a href=\'#\'>Załóż nowe konto</a></li>
						<li class="p_stop_account"><a href=\'#\'>Zablokuj konto</a></li>
						<li class="p_start_account"><a href=\'#\'>Odblokuj konto</a></li>
						<li class="p_new_password"><a href=\'#\'>Wygeneruj nowe hasło</a></li>
					</ul>				
				';
				}
				
$ShowPanelBox .= '				
				<div class="PanelAccordionHeader">
					<h2>Klienci</h2>
					<span></span>
				</div>
			
				<ul class="PanelAccordionContent">
					<li class="p_new_customer"><a href=\'#\'>Dodaj nowego klienta</a></li>
					<li class="p_customer_data"><a href=\'#\'>Pokaż klientów</a></li>

				</ul>				
				';				
				
$ShowPanelBox .= 
				'<div class="PanelAccordionHeader">
					<h2>Produkty</h2>
					<span></span>
				</div>
				
				<ul class="PanelAccordionContent">
					<li class="add_new_product"><a href=\'#\'>Wprowadź nowy produkt</a></li>
					<li class="edit_product"><a href=\'#\'>Edytuj produkt</a></li>
				</ul>
				';
$ShowPanelBox .= '
				<div class="PanelAccordionHeader">
					<h2>Magazyn</h2>
					<span></span>
				</div>
				
				<ul class="PanelAccordionContent">
					<li class="show_items"><a href=\'#\'>Sprawdź stany</a></li>
					<li class="update_items"><a href=\'#\'>Przyjmij towar</a></li>
					<li class="give_item"><a href=\'#\'>Wydaj towar</a></li>
				</ul>
				
				<div class="PanelAccordionHeader">
					<h2>Dokumenty</h2>
					<span></span>
				</div>			
			
				<ul class="PanelAccordionContent">
					<li class="wz_document"><a href=\'#\'>Wydanie z magazynu</a></li>
					<li class="report_document"><a href=\'#\'>Raporty</a></li>
				</ul>				
			</div>	
		
		</div>
		<div class="PanelAction">
			<div class="ActionBoxTitle">
				<p style="text-align: center;">PLAS - MAG v1.0</p>
					<hr style="color: blue;">
				</div>
			<div class="WelcomeText">
				<p>Witamy w panelu głównym aplikacji PLAS-MAG.</p>
				<p>Pamiętaj aby po zakończeniu pracy wylogować się z aplikacji!</p>
			</div>
		</div>
	</div>
	';
?>