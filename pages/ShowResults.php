<pre>
	<?php //print_r($_POST); ?>
	
	
</pre>

<?php
$datafilelink = 'datafiles/db.json';


if( isset($_POST['childs_data']) ){
	
	$datatofile = $_POST['childs_data'];

	filejasonencode($datafilelink, $datatofile);
}


$date = date('Y-m-d');
$today = date("d");
$date_now = date('Y-m-d');
$thisYear = date("Y");
$thisMonthNumber = date("m");
$selectedMonth = getMonthWordInLithuanian($thisMonthNumber);
	if( isset($_POST['month']) and is_string($_POST['month']))
		$selectedMonth = getMonthWordInLithuanian($_POST['month'],1);
	

?>
<div class="row">
	<div class="col-12">
		<h1>Vaikų lankomumo ir maitinimo apskaičiavimo žiniaraštis</h1>
		<h3><?php echo $thisYear.' m. '.$selectedMonth.' mėn.'; ?></h3>
	</div>
</div>
<div class="row">
	
	<div class="col-12">

		<table class="table table-success table-striped">

		<thead>
		  <tr>
			<th rowspan="2" style="width: 40px;">Eil. Nr.</th>
			<th colspan="2">Vaiko</th>
			<th colspan="2">Priskaičiuota už lankymą</th>
			<th colspan="3">Priskaičiuota už maitinimą</th>
			<th rowspan="2" style="width: 80px;">Kompensacija</th>
			<th rowspan="2" style="width: 80px;">Suma mokėti viso, su nuolaida</th>
		  </tr>
		  <tr>
			<th style="width: 150px;">Vardas</th>
			<th>Pavardė</th>
			<th style="width: 80px;">Pagrindinėje grupėje</th>
			<th style="width: 80px;">Prailgintoje grupėje</th>
			<th style="width: 80px;">Pusryčius</th>
			<th style="width: 80px;">Pietus</th>
			<th style="width: 80px;">Vakarienę</th>
		  </tr>
		</thead>
		<tbody>
		
		
		<?php 
		
				$summaintax = 0;
				$sumextendtax = 0;
				$sumfeeding_breakfast = 0;
				$sumfeeding_lunch = 0;
				$sumfeeding_dinner = 0;
				$sumalltax = 0;
				$no = 1;
		   // if( isset($_POST['childs_data']) AND is_array($_POST['childs_data']) 
              //     AND count($_POST['childs_data']) > 0) :
	
				$datafile = file_get_contents($datafilelink);
				$datafileinfo = json_decode($datafile, true);
				if($datafileinfo):
				
				//$childs_data = $_POST['childs_data'];
                  $childs_data = $datafileinfo;

			 foreach($childs_data as $index => $child_data) {
				 $maintax = 0; 
				 $extendtax = 0;
				 $feeding_breakfast = 0;
				 $feeding_lunch = 0;
				 $feeding_dinner = 0;
				 
				 if( is_array($child_data) ) {
					 if($child_data['name'] != '' || $child_data['surname'] != '') {
				 $name = $child_data['name'];
				 $surname = $child_data['surname'];
				 
				 if(isset($child_data['visiting_main_group']))
					$maintax = 10;
					$summaintax += $maintax;
				 
				 if(isset($child_data['visiting_extended_group']))
					$extendtax = 1.50;
					$sumextendtax += $extendtax;
				 
				 if(isset($child_data['feeding_breakfast']))
					$feeding_breakfast = 0.70;
					$sumfeeding_breakfast += $feeding_breakfast;
				 
				 if(isset($child_data['feeding_lunch']))
					$feeding_lunch = 1.10;
					$sumfeeding_lunch += $feeding_lunch;
				
				 if(isset($child_data['feeding_dinner']))
					$feeding_dinner = 0.70;
					$sumfeeding_dinner += $feeding_dinner;
				 $discount = 0;
				 if(isset($child_data['discount']));
					$discount = $child_data['discount'];
				 $fullEatDay = $feeding_breakfast + $feeding_lunch + $feeding_dinner;
				 $fulPrice = $maintax + $extendtax + $fullEatDay;
				 if($discount)
					$fulPrice = $maintax + $extendtax-($extendtax*($discount/100)) + $fullEatDay-($fullEatDay*($discount/100));
				
				$sumalltax += $fulPrice;
		?>
		  <tr>
			<td><?php echo $no++; ?></td>
			<td style="text-align: left;"><?php echo $name; ?></td>
			<td style="text-align: left;"><?php echo $surname; ?></td>
			<td style="text-align: right;"><?php echo number_format($maintax,2,","," "); ?></td>
			<td style="text-align: right;"><?php echo number_format($extendtax,2,","," "); ?></td>
			<td style="text-align: right;"><?php echo number_format($feeding_breakfast,2,","," "); ?></td>
			<td style="text-align: right;"><?php echo number_format($feeding_lunch,2,","," "); ?></td>
			<td style="text-align: right;"><?php echo number_format($feeding_dinner,2,","," "); ?></td>
			<td style="text-align: right;"><?php echo $discount.' %'; ?></td>
			<td style="text-align: right;"><?php echo number_format($fulPrice,2,","," "); ?></td>
		  </tr>
		  
			<?php }}} endif; ?>
			<tfoot>
				<tr>
				    <th colspan="3" style="text-align: right;">Suma viso:</th>
				    <th style="text-align: right;"><?php echo number_format($summaintax,2,","," "); ?></th>
					<th style="text-align: right;"><?php echo number_format($sumextendtax,2,","," "); ?></th>
					<th style="text-align: right;"><?php echo number_format($sumfeeding_breakfast,2,","," "); ?></th>
					<th style="text-align: right;"><?php echo number_format($sumfeeding_lunch,2,","," "); ?></th>
					<th style="text-align: right;"><?php echo number_format($sumfeeding_dinner,2,","," "); ?></th>
					<th>X</th>
					<th style="text-align: right;"><?php echo number_format($sumalltax,2,","," "); ?></th>
				</tr>
			</tfoot>
		</tbody>
		</table>
	</div>
</div>