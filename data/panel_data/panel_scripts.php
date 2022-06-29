<?php

$SaveScripts = '
<script>
function NewDiv()
{
	$(\'.PanelAction\').remove();
	var $newdiv1 = $( "<div class=\"PanelAction\"></div>" ),
	newdiv2 = document.createElement( "div" ),
	existingdiv1 = document.getElementById( "foo" );
	$(\'.MainPanelWindow\').append( $newdiv1, [ newdiv2] );
	//var htmlString = $(\'.PanelAction\').html();
	//alert(htmlString);	
}

$(document).ready(function() {
	/*Menu harmonijkowe*/
	$(\'.PanelAccordionContent\').hide();
	$(\'.PanelAccordionHeader\').click(function() {
		$(\'.PanelAccordionContent:visible\').slideUp(\'slow\').prev().removeClass(\'PanelAccordionHeaderActive\');
		$(\'.icon-active:visible\').removeClass(\'icon-active\');
		$(this).addClass(\'PanelAccordionHeaderActive\').next().slideDown(\'slow\');
		$(this).find(\'span\').addClass(\'icon-active\');
	});
	/*Interfejs zmiany hasła*/	
	$(\'.p_change_password\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=1",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk zmiany hasła*/
	$(document).on("click","#ButtonPasswordChange", function() {
		var pOldPassword = $(\'input[name=Field-old-password]\').val();
		var pNewPassword = $(\'input[name=Field-new-password]\').val();
		var pNewPassword2 = $(\'input[name=Field-new-password-2]\').val();
						
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=11&oldpassword="+pOldPassword+"&newpassword="+pNewPassword+"&newpassword2="+pNewPassword2,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
				return false;
	});
	/*Interfejs zmiany danych*/
	$(\'.p_user_data\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=2",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk aktualizujący dane tabeli pracownicy*/
	$(document).on("click","#ButtonUpdate", function() {
		var pdataUserName = $(\'input[name=user-name]\').val();
		var pdataUserSurname = $(\'input[name=user-surname]\').val();
		var pdataUserDate_1 = $(\'input[name=user-date-1]\').val();
		var pdataUserDate_2 = $(\'input[name=user-date-2]\').val();
		var pdataUserNote = $(\'input[name=user-note]\').val();
						
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=22&dataUserName="+pdataUserName+"&dataUserSurname="+pdataUserSurname+"&dataUserDate_1="+pdataUserDate_1+"&dataUserDate_2="+pdataUserDate_2+"&dataUserNote="+pdataUserNote,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});

	/*Przycisk wylogowujący użytkownika*/
	$(\'.p_logout\').click(function() {
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=3",
			success: function(phpmessages){
				if(phpmessages == "#LogOutSuccess"){
					$(\'.MainPanelWindow\').slideUp(800, function(){
							location.reload();
					});
				}
			}
		});
		return false;
	});
';
	
if($_SESSION['UserPrivileges'] == 1){
					
$SaveScripts .= '	
	/*Interfejs dodawania nowego konta*/
	$(\'.p_new_account\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=4",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk dodający nowe konto do bazy danych*/
	$(document).on("click","#ButtonAddAccount", function() {
		var pdataName = $(\'input[name=Field-name]\').val();
		var pdataSurname = $(\'input[name=Field-surname]\').val();
		var pdataLogin = $(\'input[name=Field-login]\').val();
		var pdataPassword = $(\'input[name=Field-password]\').val();
		var pdataPassword_2 = $(\'input[name=Field-password-2]\').val();
		var pAcAdmin;
	
		if($(\'input[name=admin_choice]\').is(\':checked\'))
		{
			pAcAdmin = "1";
		}else{
			pAcAdmin = "0";
		}
		
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=41&pUserLogin="+pdataLogin+"&pUserPassword="+pdataPassword+"&pUserPassword2="+pdataPassword_2+"&AdminChecked="+pAcAdmin+"&UserName="+pdataName+"&UserSurame="+pdataSurname,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Interfejs blokujący konto*/
	$(\'.p_stop_account\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=42",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk blokujący konto*/
	$(document).on("click","#ButtonStopAccount", function() {
		var selectedValue  = AccountsList.value;
		
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=43&Option="+selectedValue,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Interfejs odblokujący konto*/
	$(\'.p_start_account\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=44",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk odblokujący konto*/
	$(document).on("click","#ButtonStartAccount", function() {
		var selectedValue_b = AccountsList_b.value;	
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=45&Option="+selectedValue_b,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Interfejs do zmiany hasła wskazanego konta*/
	$(\'.p_new_password\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=48",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk umożliwiający zmianę hasła dla wybranego konta*/
	$(document).on("click","#ButtonNewPsv", function() {
		var pNewPasswordp = $(\'input[name=Field-new-password-p]\').val();
		var pNewPassword2p = $(\'input[name=Field-new-password-2-p]\').val();
		var selectedValue_d = AccountsList_d.value;
						
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=49&pnewpassword="+pNewPasswordp+"&pnewpassword2="+pNewPassword2p+"&Option="+selectedValue_d,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
				return false;
	});
	
';
}
$SaveScripts .= '
	/*Interfejs do wprowadzania nowego klienta*/
	$(\'.p_new_customer\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=5",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk umożliwiający wprowadzenie klienta do bazy danych*/
	$(document).on("click","#ButtonAddCustomer", function() {
		var Customer_cmp_name = $(\'input[name=Company-name]\').val();
		var Customer_cmp_nip = $(\'input[name=Company-nip]\').val();
		var Customer_cmp_regon = $(\'input[name=Company-regon]\').val();
		
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=51&customer_cmp_name="+Customer_cmp_name+"&customer_cmp_nip="+Customer_cmp_nip+"&customer_cmp_regon="+Customer_cmp_regon,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
				return false;
	});
	/*Interfejs do danych klienta*/
	$(\'.p_customer_data\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=52",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Przycisk wysyłający id klienta, którego dane mają zostać pokazane*/	
	$(document).on("click","#ButtonCstData", function() {
		var RadioList = document.getElementsByName(\'CustomerRadioB\');
		var RadioId;
		for (var i = 0, length = RadioList.length; i < length; i++) {
			if (RadioList[i].checked) {
				RadioId = RadioList[i].value;
				//alert(RadioList[i].value);
				break;
			}
		}
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=53&IdCustomer="+RadioId,
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;			
	});
	/*Przycisk aktualizujący dane tabeli adres (wersja dla klienta)*/
	$(document).on("click","#BtnUpdateDataAdress2", function() {
		var pdataUserCity = $(\'input[name=user-city]\').val();
		var pdataUserCityCode = $(\'input[name=user-city-code]\').val();
		var pdataUserProvince = $(\'input[name=user-province]\').val();
		var pdataUserStreet = $(\'input[name=user-street]\').val();
		var pdataUserStreetNr = $(\'input[name=user-street-nr]\').val();
		var pdataUserStreetFlat = $(\'input[name=user-street-flat]\').val();
						
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=54&dataUserCity="+pdataUserCity+"&dataUserCityCode="+pdataUserCityCode+"&dataUserProvince="+pdataUserProvince+"&dataUserStreet="+pdataUserStreet+"&dataUserStreetNr="+pdataUserStreetNr+"&dataUserStreetFlat="+pdataUserStreetFlat,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Przycisk aktualizujący dane tabeli kontakty (wersja dla klienta)*/
	$(document).on("click","#ButtonUpdateDataCon2", function() {
		var pdataUserTelKom = $(\'input[name=user-tel-kom]\').val();
		var pdataUserTelSta = $(\'input[name=user-tel-sta]\').val();
		var pdataUserFax = $(\'input[name=user-fax]\').val();
		var pdataUserMail = $(\'input[name=user-mail]\').val();
						
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=55&dataUserTelKom="+pdataUserTelKom+"&dataUserTelSta="+pdataUserTelSta+"&dataUserFax="+pdataUserFax+"&dataUserMail="+pdataUserMail,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Przycisk aktualizujący dane tabeli klienci*/
	$(document).on("click","#ButtonUpdate2", function() {
		var pdataCustomerName = $(\'input[name=user-name]\').val();
		var pdataCustomerNip = $(\'input[name=user-nip]\').val();
		var pdataCustomerRegon = $(\'input[name=user-regon]\').val();
						
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=56&CustomerName="+pdataCustomerName+"&CustomerNip="+pdataCustomerNip+"&CustomerRegon="+pdataCustomerRegon,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Interfejs do wprowadzania nowego produktu*/
	$(\'.add_new_product\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=592",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Przycisk wprowadzający nowy produktu do bazy*/
	$(document).on("click","#ButtonNewProduct", function() {
		var pdataProductName = $(\'input[name=Product-name]\').val();
		var pdataProductJm = $(\'input[name=Product-jm]\').val();
		
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=593&ProductName="+pdataProductName+"&ProductJm="+pdataProductJm,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Interfejs do edycji istniejącego produktu*/
	$(\'.edit_product\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=594",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Przycisk wysyłający id produktu, którego dane mają zostać pokazane i zmienione*/	
	$(document).on("click","#ButtonProdData", function() {
		var RadioList = document.getElementsByName(\'ProductRadioB\');
		var RadioId;
		for (var i = 0, length = RadioList.length; i < length; i++) {
			if (RadioList[i].checked) {
				RadioId = RadioList[i].value;
				//alert(RadioList[i].value);
				break;
			}
		}
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=595&IdProduct="+RadioId,
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;			
	});
	/*Przycisk wprowadzający nowe dane produktu do bazy*/
	$(document).on("click","#ButtonEditProduct", function() {
		var pdataProductName = $(\'input[name=Product-name]\').val();
		var pdataProductJm = $(\'input[name=Product-jm]\').val();
		
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=596&ProductName="+pdataProductName+"&ProductJm="+pdataProductJm,
			success: function(phpmessages){
						alert(phpmessages);
					}
				});
			return false;
	});
	/*Prezentacja stanów magazynowych*/
	$(\'.show_items\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=6",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Przyjęcie towaru do magazynu*/
	$(\'.update_items\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=61",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Interfejs do wydania towaru - krok 1 wybór klienta*/
	$(\'.give_item\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=63",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Interfejs do wydania towaru - krok 2 wybór towaru*/
	$(document).on("click","#ButtonThisCustomer", function() {
		var RadioList = document.getElementsByName(\'CustomerItRadioB\');
		var RadioId;
		for (var i = 0, length = RadioList.length; i < length; i++) {
			if (RadioList[i].checked) {
				RadioId = RadioList[i].value;
				//alert(RadioList[i].value);
				break;
			}
		}
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=64&IdCustomer="+RadioId,
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Przycisk do wydania towaru - krok 3 zobaczenie listy towarów*/
	$(document).on("click","#ShowItemList", function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=66",
			success: function(phpmessages){
						$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
						//alert(phpmessages);
					}
				});
			return false;
	});
	/*Przycisk do odświerzenia listy towarów*/
	$(document).on("click","#RefreshItemList", function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=66",
			success: function(phpmessages){
						$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
						//alert(phpmessages);
					}
				});
			return false;
	});
	/*Przycisk powrotu wydań towarów*/
	$(document).on("click","#BackToItems", function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=69",
			success: function(phpmessages){
						$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
						//alert(phpmessages);
					}
				});
			return false;
	});
	/*Przycisk kończący wydawanie towarów*/
	$(document).on("click","#EndItemList", function() {
		$(\'.PanelAction\').fadeOut("slow");
	});
	/*Przyjęcie towaru do magazynu*/
	$(\'.wz_document\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=70",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Przezentacja dokumentu WZ*/
	$(document).on("click","#ButtonChoiceWZ", function() {
		var RadioList = document.getElementsByName(\'WZcustomer\');
		var RadioId;
		for (var i = 0, length = RadioList.length; i < length; i++) {
			if (RadioList[i].checked) {
				RadioId = RadioList[i].value;
				//alert(RadioList[i].value);
				break;
			}
		}
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=71&NrWZ="+RadioId,
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});
		return false;
	});
	/*Wyświetlenie raportu*/
	$(\'.report_document\').click(function() {
		NewDiv();
		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=72",
			success: function(phpmessages){
				$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");
			}
		});		
		return false;
	});
	/*Przycisk wyszukujący wystawione dokumenty WZ*/
	$(document).on("click","#FindWZ", function() {
		var pdataStart = $(\'input[name=date-start]\').val();
		var pdataStop = $(\'input[name=date-stop]\').val();

		$.ajax({
			url: "panel_set.php",
			type: "POST",
			data: "pValue=73&DataStart="+pdataStart+"&DataStop="+pdataStop,
			success: function(phpmessages){
						
						if(phpmessages == "#ERROR_DATA_START"){
							alert("Data początkowa jest niepoprawna!");
						}
						else if(phpmessages == "#ERROR_DATA_STOP"){
							alert("Data końcowa jest niepoprawna!");
						}
						else if(phpmessages == "#ERROR_DATA") {
							alert("Data końcowa musi być większa od daty początkowej!");
						}
						else {
							NewDiv();
							$(\'.PanelAction\').css("display","none").html(phpmessages).fadeIn("slow");	
						}											
					}
				});
			return false;
	});
});
</script>
';
?>
