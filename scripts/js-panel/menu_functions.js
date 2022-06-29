<script>
	function FilterData(FieldName,TableName,NumberColumn) {
	    var FiledDataName, chfilter, ListData, DataRow, DataColumn, i;
			  
	    FiledDataName = document.getElementById(FieldName);
	    chfilter = FiledDataName.value.toUpperCase();
	    ListData = document.getElementById(TableName);
	    DataRow = ListData.getElementsByTagName("tr");
		    for (i = 0; i < DataRow.length; i++) {
				DataColumn = DataRow[i].getElementsByTagName("td")[NumberColumn];
					if (DataColumn) {
		  	 		    if (DataColumn.innerHTML.toUpperCase().indexOf(chfilter) > -1) {
							DataRow[i].style.display = "";
						} else {
							DataRow[i].style.display = "none";
						}
					}       
		   }
	}

	function UpdateItm(FieldID,ItemID,ItemName,ItemJM) {
		var HowMany = document.getElementById(FieldID).value;
		
		$(document).ready(function() {
			$.ajax({
				url: "panel_set.php",
				type: "POST",
				data: "pValue=62&ItemID="+ItemID+"&HowMany="+HowMany,
				success: function(phpmessages){
						//document.getElementById("ProductsStatus").innerHTML = "Przyjęto "+ItemName+" w ilości "+HowMany+" "+ItemJM+".";
						$('#ProductsStatus').css("display","none").text(phpmessages).fadeOut(400).fadeIn(400);
				}
			});
		});

	}	

	function GiveItm(FieldID,ItemID,ItemName,ItemJM) {
		var HowMany = document.getElementById(FieldID).value;
		
		$(document).ready(function() {
			$.ajax({
				url: "panel_set.php",
				type: "POST",
				data: "pValue=65&ItemID="+ItemID+"&HowMany="+HowMany+"&ItemName="+ItemName+"&ItemJm="+ItemJM,
				success: function(phpmessages){
						//document.getElementById("ProductsStatus").innerHTML = "Przyjęto "+ItemName+" w ilości "+HowMany+" "+ItemJM+".";
						$('#ProductsStatus').css("display","none").text(phpmessages).fadeOut(400).fadeIn(400);
				}
			});
		});

	}

	function CorrItm(FieldID,Lp,IdProduct,ItemName,ItemJM) {
		var HowMany = document.getElementById(FieldID).value;

		$(document).ready(function() {
			$.ajax({
				url: "panel_set.php",
				type: "POST",
				data: "pValue=67&Lp="+Lp+"&HowMany="+HowMany+"&IdProduct="+IdProduct+"&ItemName="+ItemName+"&ItemJM="+ItemJM,
				success: function(phpmessages){
						//document.getElementById("ProductsStatus").innerHTML = "Przyjęto "+ItemName+" w ilości "+HowMany+" "+ItemJM+".";
						$('#ProductsStatus').css("display","none").text(phpmessages).fadeOut(400).fadeIn(400);
				}
			});
		});

	}
	
	function DelItm(Lp,IdProduct) {

		$(document).ready(function() {
			$.ajax({
				url: "panel_set.php",
				type: "POST",
				data: "pValue=68&Lp="+Lp+"&IdProduct="+IdProduct,
				success: function(phpmessages){
						//document.getElementById("ProductsStatus").innerHTML = "Przyjęto "+ItemName+" w ilości "+HowMany+" "+ItemJM+".";
						$('#ProductsStatus').css("display","none").text(phpmessages).fadeOut(400).fadeIn(400);
				}
			});
		});

	}
	
	function ovStyle(object){
		object.style.fontWeight = "bold";
	}
	
	function ouStyle(object){
		object.style.fontWeight = "normal";
	}
</script>