<?php

require_once('data/database_connect/data_connect.php');

$Report = '
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Raporty</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Data początkowa (rrrr-mm-dd):</span></br>
									<input type="text" name="date-start" id="date-start"/></br></br>
									<span class="ActionBoxData">Data końcowa (rrrr-mm-dd):</span></br>
									<input type="text" name="date-stop" id="date-stop"/></br></br>
									<input type="button" name="FindWZ" id="FindWZ" value="Sprawdź"/>
								</div>
							</div>
						</div>
				';
?>