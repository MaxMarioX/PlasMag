<?php

@session_start();

$_choice = $_POST['pValue'];
$_ThisUser = $_SESSION['UserLogin'];
$_ThisIdUser = $_SESSION['UserID'];

/*Kod odpowiedzialny za wyświetlenie interfejsu do zmiany hasła*/
if($_choice == 1){
	$Result;
	
	function change_password_part1($_User,&$Result)
	{
		//Wyświetlenie kodu zmiany hasła
		require_once('data/panel_data/change_password_part1.php');
		$Result = $ShowPanelChangeLogin;
	}
	change_password_part1($_ThisUser, $Result);
	exit($Result);
}
/*Kod odpowiedzialny za zmianę hasła*/
if($_choice == 11){
	$Result;
	
	function change_password_part2($_User,&$Result)
	{
		//Zmiana hasła
		require_once('data/panel_data/change_password_part2.php');	
	}
	change_password_part2($_ThisUser, $Result);
	exit($Result);
}
/*Kod odpowiedzialny za wyświetlenie interfejsu do zmiany danych*/
if($_choice == 2){
	$Result;
	
	function show_user_data($_User,$_Id,&$Result)
	{
		//Wyświetlenie danych użytkownika
		require_once('data/panel_data/show_user_data.php');
		$Result = $ShowUserData;
	}	
	show_user_data($_ThisUser, $_ThisIdUser, $Result);
	exit($Result);
}
/*Kod odpowiedzialny za zmianę danych z tabeli 'pracownicy'*/
if($_choice == 22){
	$Result;
	
	function update_user_data($_Id,&$Result,$pdataUserName,$pdataUserSurname,$pdataUserDate_1,$pdataUserDate_2,$dataUserNote)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/update_user_data.php');
	}	
	update_user_data($_ThisIdUser,$Result,$_POST['dataUserName'],$_POST['dataUserSurname'],$_POST['dataUserDate_1'],$_POST['dataUserDate_2'],$_POST['dataUserNote']);
	exit($Result);
}

/*Kod odpowiedzialny za wylogowanie*/
if($_choice == 3){
	$Result;
	
	function log_out(&$Result) 
	{
		//Wylogowanie użytkownika
		require_once('data/panel_data/logout.php');
		$Result = "#LogOutSuccess";
	}
	log_out($Result);
	exit($Result);
}

/*Kod odpowiedzialny za wyświetlenie interfejsu do dodawania nowego konta*/
if($_choice == 4){
	$Result;
	
	function add_new_account_part1(&$Result) 
	{
		//Dodawanie nowego konta
		require_once('data/panel_data/add_new_account_part1.php');
		$Result = $ShowPanelNewAccount;
	}
	add_new_account_part1($Result);
	exit($Result);
}

/*Kod odpowiedzialny za dodanie nowego konta*/
if($_choice == 41){
	$Result;
	
	function add_new_account_part2(&$Result,$NewLogin,$Password,$Password_2,$Rules,$Name,$Surrname) 
	{
		//Dodawanie nowego konta
		require_once('data/panel_data/add_new_account_part2.php');
	}
	add_new_account_part2($Result,$_POST['pUserLogin'],$_POST['pUserPassword'],$_POST['pUserPassword2'],$_POST['AdminChecked'],$_POST['UserName'],$_POST['UserSurame']);
	exit($Result);
}
/*Kod odpowiedzialny za wyświetlenie interfejsu do blokady konta*/
if($_choice == 42){
	$Result;
	
	function lock_account(&$Result) 
	{
		//Blokwanie konta
		require_once('data/panel_data/lock_account_part1.php');
		$Result = $ShowPanelStopAccount;
	}
	lock_account($Result);
	exit($Result);
}
/*Kod odpowiedzialny za blokadę konta*/
if($_choice == 43){
	$Result;
	
	function stop_account_now(&$Result,$uLogin)
	{
		//Blokwanie konta
		require_once('data/panel_data/lock_account_part2.php');
	}
	stop_account_now($Result,$_POST['Option']);
	exit($Result);
}
/*Kod odpowiedzialny za wyświetlenie interfejsu do odblokowania konta*/
if($_choice == 44){
	$Result;
	
	function unlock_account_part1(&$Result)
	{
		//Odblokowanie konta
		require_once('data/panel_data/unlock_account_part1.php');
		$Result = $ShowPanelStopAccount;
	}
	unlock_account_part1($Result);
	exit($Result);
}
/*Kod odpowiedzialny za odblokowanie konta*/
if($_choice == 45){
	$Result;
	
	function unlock_account_part2(&$Result,$uLogin)
	{
		//Odblokowanie konta
		require_once('data/panel_data/unlock_account_part2.php');
	}
	unlock_account_part2($Result,$_POST['Option']);
	exit($Result);
}

/*Kod odpowiedzialny za wyświetlenie interfejsu do zmiany hasła dla konta*/
if($_choice == 48){
	$Result;
	
	function change_user_password_part1(&$Result)
	{
		//Wybranie konta
		require_once('data/panel_data/change_user_password_part1.php');
		$Result = $ShowAccountPsv;
	}
	change_user_password_part1($Result);
	exit($Result);
}
if($_choice == 49){
	$Result;
	
	function change_user_password_part2($_User,&$Result, $p_newPassword, $p_newPassword2)
	{
		//Zmiana hasła
		require_once('data/panel_data/change_user_password_part2.php');
	}
	change_user_password_part2($_POST['Option'],$Result,$_POST['pnewpassword'],$_POST['pnewpassword2']);
	exit($Result);
}
/*Wprowadzanie nowego klienta do bazy danych - interfejs*/
if($_choice == 5){
	$Result;
	
	function add_new_customer(&$Result)
	{	
		//Wybranie konta
		require_once('data/panel_data/add_new_customer_part1.php');
		$Result = $ShowPanelNewAccount;
	}
	add_new_customer($Result);
	exit($Result);
}
/*Wprowadzanie nowego klienta do bazy danych - zatwierdzenie*/
if($_choice == 51){
	$Result;

	function new_customer_now_part2(&$Result,$CustomerName,$CustomerNip,$CustomerRegon)
	{	
		//Wybranie konta
		require_once('data/panel_data/add_new_customer_part2.php');
	}
	new_customer_now_part2($Result,$_POST['customer_cmp_name'],$_POST['customer_cmp_nip'],$_POST['customer_cmp_regon']);
	exit($Result);
}
/*Wyświetlenie tabeli z klientami*/
if($_choice == 52){
	$Result;

	function show_customers_part1(&$Result)
	{	
		//Wybranie konta
		require_once('data/panel_data/show_customers_part1.php');
		$Result = $ShowCustomerData;
	}
	show_customers_part1($Result);
	exit($Result);
}
/*Wyświetlenie szczegółowych danych klientów*/
if($_choice == 53){
	$Result;

	function show_customer_data2(&$Result,$_Id)
	{	
		//Wybranie konta
		require_once('data/panel_data/show_customers_part2.php');
		$Result = $ShowCustomerData2;
	}
	$_SESSION['CustomerId'] = $_POST['IdCustomer'];
	show_customer_data2($Result,$_SESSION['CustomerId']);
	
	exit($Result);
}
/*Aktualizowanie adresu klientów*/
if($_choice == 54){
	$Result;

	function update_customer_adress($_Id,&$Result,$pdataUserCity,$pdataUserCityCode,$pdataUserProvince,$pdataUserStreet,$pdataUserStreetNr,$pdataUserStreetFlat)
	{	
		//Wybranie konta
		require_once('data/panel_data/update_customer_adress.php');
	}

	update_customer_adress($_SESSION['CustomerId'],$Result,$_POST['dataUserCity'],$_POST['dataUserCityCode'],$_POST['dataUserProvince'],$_POST['dataUserStreet'],$_POST['dataUserStreetNr'],$_POST['dataUserStreetFlat']);
	
	exit($Result);
}
/*Aktualizowanie kontaktu klientów*/
if($_choice == 55){
	$Result;

	function update_customer_contact($_Id,&$Result,$pdataUserTelKom,$pdataUserTelSta,$pdataUserFax,$pdataUserMail)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/update_customer_contact.php');
	}	
	update_customer_contact($_SESSION['CustomerId'],$Result,$_POST['dataUserTelKom'],$_POST['dataUserTelSta'],$_POST['dataUserFax'],$_POST['dataUserMail']);
	
	exit($Result);
}
/*Aktualizowanie danych klientów*/
if($_choice == 56){
	$Result;

	function update_customer_data(&$Result,$CustomerId,$CustomerName,$CustomerNip,$CustomerRegon)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/update_customer_data.php');
	}	
	update_customer_data($Result,$_SESSION['CustomerId'],$_POST['CustomerName'],$_POST['CustomerNip'],$_POST['CustomerRegon']);
	
	exit($Result);
}

/*Interfejs do wprowadzania nowego produktu*/
if($_choice == 592){
	$Result;

	function add_new_product_part1(&$Result)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/add_new_product_part1.php');
		$Result = $AddNewProduct;
	}	
	add_new_product_part1($Result);
	
	exit($Result);
}

/*Wprowadzanie nowego produktu do bazy danych*/
if($_choice == 593){
	$Result;

	function add_new_product_part2(&$Result,$ProductName,$ProductJM)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/add_new_product_part2.php');
	}	
	add_new_product_part2($Result,$_POST['ProductName'],$_POST['ProductJm']);
	
	exit($Result);
}
/*Interfejs do edycji istniejącego produktu*/
if($_choice == 594){
	$Result;

	function edit_product_part1(&$Result)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/edit_product_part1.php');
		$Result = $ShowProductsData;
	}	
	edit_product_part1($Result);
	
	exit($Result);
}
/*Przycisk wysyłający id produktu, którego dane mają zostać pokazane i zmienione*/	
if($_choice == 595){
	$Result;

	function edit_product_part2(&$Result, $ProductId)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/edit_product_part2.php');
		$Result = $EditProduct;
	}	
	edit_product_part2($Result,$_POST['IdProduct']);
	
	exit($Result);
}
/*Przycisk wprowadzający nowe dane produktu do bazy*/
if($_choice == 596){
	$Result;

	function edit_product_part3(&$Result,$ProductName,$ProductJM,$ProductId,$ProductHM)
	{
		//Aktualizacja danych użytkownika
		require_once('data/panel_data/edit_product_part3.php');
	}	
	edit_product_part3($Result,$_POST['ProductName'],$_POST['ProductJm'],$_SESSION['ProductId'],$_SESSION['ProductHowMany']);
	
	exit($Result);
}

//Przedstawienie stanów magazynowych
if($_choice == 6){
	$Result;

	function show_items(&$Result)
	{
		require_once('data/panel_data/show_items.php');
		$Result = $ShowItems;
	}	
	show_items($Result);
	
	exit($Result);
}
//Przyjęcie towaru do magazynu
if($_choice == 61){
	$Result;

	function take_items_part1(&$Result)
	{
		require_once('data/panel_data/take_items_part1.php');
		$Result = $ShowItems;
	}	
	take_items_part1($Result);
	
	exit($Result);
}
//Aktualizowanie stanów magazynowych
if($_choice == 62){
	$Result;

	function take_items_part2(&$Result,$IdItem,$HowMany)
	{
		require_once('data/panel_data/take_items_part2.php');
	}	
	take_items_part2($Result,$_POST['ItemID'],$_POST['HowMany']);	
	
	exit($Result);
}
//Wydanie towaru - krok 1 wybór klienta
if($_choice == 63){
	$Result;

	function give_item_part1(&$Result)
	{
		require_once('data/panel_data/give_item_part1.php');
		$Result = $ShowCustomerData;
	}	
	give_item_part1($Result);	
	
	exit($Result);
}
//Wydanie towaru - krok 2 wybór towaru dla klienta
if($_choice == 64){
	$Result;

	function give_item_part2(&$Result,$IdCustomer,$UserID)
	{
		require_once('data/panel_data/give_item_part2.php');
		$Result = $ShowItemsG;
	}

	$_SESSION['CustomerIdGive'] = $_POST['IdCustomer'];		
	give_item_part2($Result,$_SESSION['CustomerIdGive'],$_SESSION['UserID']);	
	
	exit($Result);
}
//Wydanie towaru - krok 3 zapis wyboru towaru w relacji "wydania"
if($_choice == 65){
	$Result;

	function give_item_part3(&$Result,$IdItem,$hm,$NameItem,$JmItem)
	{
		require_once('data/panel_data/give_item_part3.php');
	}

	give_item_part3($Result,$_POST['ItemID'],$_POST['HowMany'],$_POST['ItemName'],$_POST['ItemJm']);	
	
	exit($Result);
}
//Wydanie towaru - krok 4 przejrzenie towarów
if($_choice == 66){
	$Result;

	function give_item_part4(&$Result)
	{
		require_once('data/panel_data/give_item_part4.php');
		$Result = $ShowItemsWz;
	}

	give_item_part4($Result);	
	
	exit($Result);
}
//Skorygowanie towaru - krok 5 korekta ilości wydanego produktu
if($_choice == 67){
	$Result;

	function give_item_part5(&$Result,$_Lp,$_HowMany,$_IdProduct,$_ItemName,$_ItemJM)
	{
		require_once('data/panel_data/give_item_part5.php');
	}

	give_item_part5($Result,$_POST['Lp'],$_POST['HowMany'],$_POST['IdProduct'],$_POST['ItemName'],$_POST['ItemJM']);
	
	exit($Result);
}
//Usunięcie towaru z listy i dokumentu WZ- krok 6
if($_choice == 68){
	$Result;

	function give_item_part6(&$Result,$_Lp,$_IdProduct)
	{
		require_once('data/panel_data/give_item_part6.php');
	}

	give_item_part6($Result,$_POST['Lp'],$_POST['IdProduct']);
	
	exit($Result);
}
//Usunięcie towaru z listy i dokumentu WZ- krok 7
if($_choice == 69){
	$Result;

	function give_item_part7(&$Result)
	{
		require_once('data/panel_data/give_item_part7.php');
		$Result = $ShowItemsG;
	}

	give_item_part7($Result);
	
	exit($Result);
}
//Wyświetlenie dokumentu WZ - wybór nr dokumentu
if($_choice == 70){
	$Result;

	function wz_document_part1(&$Result)
	{
		require_once('data/panel_data/wz_document_part1.php');
		$Result = $ShowWZ;
	}

	wz_document_part1($Result);
	
	exit($Result);
}
//Wyświetlenie dokumentu WZ
if($_choice == 71){
	$Result;

	function wz_document_part2(&$Result,$WzNumber)
	{
		require_once('data/panel_data/wz_document_part2.php');
		$Result = $ShowWZ;
	}

	wz_document_part2($Result,$_POST['NrWZ']);
	
	exit($Result);
}
//Wyświetlenie raportu
if($_choice == 72){
	$Result;

	function report_document_part1(&$Result)
	{
		require_once('data/panel_data/report_document_part1.php');
		$Result = $Report;
	}

	report_document_part1($Result);
	
	exit($Result);
}
//Wyświetlenie raportu
if($_choice == 73){
	$Result;

	function report_document_part2(&$Result,$_DataStart,$_DataStop)
	{
		require_once('data/panel_data/report_document_part2.php');
	}

	report_document_part2($Result,$_POST['DataStart'],$_POST['DataStop']);
	
	exit($Result);
}
?>