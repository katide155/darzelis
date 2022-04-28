<?php



date_default_timezone_set('Europe/Vilnius');
setlocale(LC_TIME, 'lt_LT');
$today = date("d");
$date_now = date('Y-m-d');
$thisYear = date("Y");
$thisMonthNumber = date("m");

$months = array(
"01" => "Sausis",
"02" => "Vasaris",
"03" => "Kovas",
"04" => "Balandis",
"05" => "Gegužė",
"06" => "Birželis",
"07" => "Liepa",
"08" => "Rugpjūtis",
"09" => "Rugsėjis",
"10" => "Spalis",
"11" => "Lapkritis",
"12" => "Gruodis"
);
$selectedMonthNumber = $thisMonthNumber;
if( isset($_POST['month']))
	$selectedMonthNumber = (int)$_POST['month'];

	
?>
<pre>
	<?php //print_r($_POST); ?>
</pre>
<form method="POST" action="showresults">
<div class="row">
	<div class="col-12">
		<h1>Vaikų lankomumo ir maitinimo registravimo žiniaraštis</h1>
	</div>
	<div class="col-1">
		<select name="year" class="form-select">
		  <option selected value="2021">2021 m.</option>
		  <option value="2022">2022 m.</option>
		  <option value="2023">2023 m.</option>
		</select>
	</div>
	<div class="col-2">
		<select name="month" class="form-select">
		<?php
			foreach($months as $key => $month){
				if($key == (int)$selectedMonthNumber)
					$selected = 'selected';				
				echo "<option $selected value='$key'>$month</option>";
				$selected = '';
			}
		?>
		</select>
	</div>	
	<div class="col-1">
		<select name="day" class="form-select">
		<?php 
			
			$daysInselectedMonth = cal_days_in_month(CAL_GREGORIAN,$selectedMonthNumber,$thisYear);
			
			$selected = '';
			for ($i = 1; $i <= $daysInselectedMonth; $i++){
				if($i == (int)$today)
					$selected = 'selected';
				echo "<option $selected value='$i'>$i</option>";
				$selected = '';
			}
			
		?>
		</select>
	</div>	
</div>
<div class="row">
	
	<div class="col-12">
		<table class="table table-success table-striped lentele">
		<thead>
		  <tr>
			<th rowspan="2">Eil. Nr.</th>
			<th colspan="2">Vaiko</th>
			<th colspan="2">Lankymas grupėje</th>
			<th colspan="3">Maitinimasis</th>
			<th rowspan="2">Kompensacija, %</th>
			<th rowspan="2">+-</th>
		  </tr>

		  <tr>
			<th>Vardas</th>
			<th>Pavardė</th>
			<th>Pagrindinėje</th>
			<th>Prailgintoje</th>
			<th>Pusryčiai</th>
			<th>Pietūs</th>
			<th>Vakarienė</th>
		  </tr>
		  
		 </thead>
		<tbody>
		<?php 
            for($i = 0; $i < 10; $i++) : 

                                $name = isset($_POST['childs_data'][$i]['name']) ? $_POST['childs_data'][$i]['name'] : '';
								$surname = isset($_POST['childs_data'][$i]['surname']) ? $_POST['childs_data'][$i]['surname'] : '';
								$visiting_main_group = '';
									isset($_POST['childs_data'][$i]['visiting_main_group']) ? $visiting_main_group = 'checked' : '';
								$visiting_extended_group = '';
									isset($_POST['childs_data'][$i]['visiting_extended_group']) ? $visiting_extended_group = 'checked' : '';
								$feeding_breakfast = '';
									isset($_POST['childs_data'][$i]['feeding_breakfast']) ? $feeding_breakfast = 'checked' : '';
								$feeding_lunch = '';
									isset($_POST['childs_data'][$i]['feeding_lunch']) ? $feeding_lunch = 'checked' : '';
								$feeding_dinner = '';
									isset($_POST['childs_data'][$i]['feeding_dinner']) ? $feeding_dinner = 'checked' : '';
								$discount = '';
									isset($_POST['childs_data'][$i]['discount']) ? $discount = $_POST['childs_data'][$i]['discount'] : '';

        ?>
		  <tr class="eilute">
			<td><?php echo $i+1; ?></td>
			<td><input type="text" name="childs_data[<?php echo $i; ?>][name]" class="form-control" value="<?php echo $name; ?>"></td>
			<td><input type="text" name="childs_data[<?php echo $i; ?>][surname]" class="form-control" value="<?php echo $surname; ?>"></td>
			<td>
				<div class="form-check">
				  <input class="form-check-input clearfix" type="checkbox" name="childs_data[<?php echo $i; ?>][visiting_main_group]" value="yes" id="visiting_main_group" <?php  echo $visiting_main_group; ?>/>
				</div>
			</td>
			<td>
				<div class="form-check">
				  <input class="form-check-input clearfix" type="checkbox" name="childs_data[<?php echo $i; ?>][visiting_extended_group]" value="yes" id="visiting_extended_group" <?php  echo $visiting_extended_group; ?>/>
				</div>
			</td>
			<td>				
				<div class="form-check">
					<input class="form-check-input clearfix" type="checkbox" name="childs_data[<?php echo $i; ?>][feeding_breakfast]" value="yes" id="feeding_breakfast" <?php  echo $feeding_breakfast; ?> />
				</div>
			</td>
			<td>				
				<div class="form-check">
					<input class="form-check-input clearfix" type="checkbox" name="childs_data[<?php echo $i; ?>][feeding_lunch]" value="yes" id="feeding_lunch" <?php  echo $feeding_lunch; ?> />
				</div>
			</td>
			<td>				
				<div class="form-check">
					<input class="form-check-input clearfix" type="checkbox" name="childs_data[<?php echo $i; ?>][feeding_dinner]" value="yes" id="feeding_dinner" <?php  echo $feeding_dinner; ?> />
				</div>
			</td>
			<td>				
				<div class="form-check">
					<select name="childs_data[<?php echo $i; ?>][discount]" class="form-select" aria-label="Default select example">
					<?php 
					$selected0 = '';
					$selected50 = '';
					$selected100 = '';
					if($discount == 0)
						$selected0 = 'selected';
					if($discount == 50)
						$selected50 = 'selected';
					if($discount == 100)
						$selected100 = 'selected';
					?>
						<option <?php echo $selected0; ?> value="0">Netaikoma</option>
						<option <?php echo $selected50; ?> value="50">50 %</option>
						<option <?php echo $selected100; ?> value="100">100 %</option>
					</select>
				</div>
			</td>
			<td>
				  <button type="submit" class="btn btn-success prideti-islaidavimo-eilute"><b>+</b></button>
				  <button type="submit" class="btn btn-danger panaikinti-islaidavimo-eilute"><b>-</b></button>
			 </td>
		  </tr>
		  <?php endfor; ?>
		</tbody>
		</table>
	</div>

	<div class="mt-5 mb-5">
		<button class="w-100 btn btn-success btn-lg" type="submit">Siųsti duomenis</button>
	</div>
</div>
</form>