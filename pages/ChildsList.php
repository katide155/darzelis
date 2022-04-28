<pre>
	<?php //print_r($_POST); ?>
	
	
</pre>

<?php

global $connection;
$childrentable = new DataBaseTable('children', $connection);
$groupstable = new DataBaseTable('groups', $connection);

if (isset($_POST['delete_child']))
{
	//include "include/trinti_klienta.php";
	//$klientoId = mysql_fetch_array(getKlientai(null, null, 'limit 1'))['id'];
	
	//redirect('/klientai');
} elseif (isset($_POST['save_child']))
{
	$childrenFields = $childrentable->showTableColumnsFields();

	$child_name = 'test';
	if( isset($_POST['child_name']) ){
		$child_name = $_POST['child_name'];
	}

	$child_surname = null;
	if( isset($_POST['child_surname']) ){
		$child_surname = $_POST['child_surname'];
	}		

	$child_group_id = null;
	if( isset($_POST['child_group_id']) ){
		$child_group_id = $_POST['child_group_id'];
	}
	
	$child_parents_email = null;
	if( isset($_POST['child_parents_email']) ){
		$child_parents_email = $_POST['child_parents_email'];
	}
	
	$child_parents_telno = null;
	if( isset($_POST['child_parents_telno']) ){
		$child_parents_telno = $_POST['child_parents_telno'];
	}

	$child_birthdate = null;
	if( isset($_POST['child_birthdate']) ){
		$child_birthdate = $_POST['child_birthdate'];
	}

	$dataToClidrenTable = array(null, $child_name, $child_surname, $child_group_id, $child_parents_email, $child_parents_telno,$child_birthdate, 'CURRENT_TIMESTAMP', null);
	$childrentable->insertDataToTable($childrenFields, $dataToClidrenTable);
	
}
$groupsFields = $groupstable->showTableColumnsFields();
$group_title = "Pelėdžiukai";
$group_number = "2";
$dataToGroupsTable = array(null, $group_title, $group_number,'CURRENT_TIMESTAMP', null);
//$groupstable->insertDataToTable($groupsFields, $dataToGroupsTable);

$children = $childrentable->selectDataFromDataBaseTable();
$groups = $groupstable->selectDataFromDataBaseTable();

//echo '<pre>';
//print_r($childrenFields);

?>
<div class="row">
	<div class="col-12">
		<h2>Vaikų sąrašas</h2>
	</div>
</div>
<div class="row">
	
	<div class="col-12">

		<table class="table table-success table-striped">

		<thead>
		  <tr>
			<th style="width: 40px;">Eil. Nr.</th>
			<th style="width: 200px;">Vardas</th>
			<th>Pavardė</th>
			<th style="width: 200px;">Grupės pavadinimas</th>
			<th style="width: 200px;">Tėvų e. pašto adresas</th>
			<th style="width: 200px;">Tėvų tel. Nr.</th>
			<th style="width: 200px;">Vaiko gimimo diena</th>
			<th style="width: 90px;">
				<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Pridėti vaiką</button>
			</th>
		  </tr>
		</thead>
		<tbody>
		
		
		<?php 

				$i = 1;

			  while($child = mysqli_fetch_assoc($children))
				  {
					  $name = $child['child_name'];
					  $surname = $child['child_surname'];
					  $group_title = '';
					  $group_id = $child['child_group_id'];
					  if($group_id){
						$where = array(0 => 'group_id='.$group_id.'');
						$group = $groupstable->selectDataFromDataBaseTable('group_title', $where);
						$row = mysqli_fetch_assoc($group);
						$group_title = $row['group_title']; 
					  }
					  
					  $parents_email = $child['child_parents_email'];
					  $parents_telno = $child['child_parents_telno'];
					  $child_birthdate = $child['child_birthdate'];
					
		?>
		  <tr>
			<td><?php echo $i++; ?></td>
			<td style="text-align: left;"><?php echo $name; ?></td>
			<td style="text-align: left;"><?php echo $surname; ?></td>
			<td style="text-align: right;"><?php echo $group_title; ?></td>
			<td style="text-align: right;"><?php echo $parents_email; ?></td>
			<td style="text-align: right;"><?php echo $parents_telno; ?></td>
			<td style="text-align: right;"><?php echo $child_birthdate; ?></td>
			<td style="text-align: right;">
				<button type="button" class="btn btn-success" data-bs-id="1" data-bs-toggle="modal" data-bs-target="#exampleModal">red</button>
				<button type="submit" name="delete_child" class="btn btn-danger"><b>-</b></button>
			</td>
		  </tr>
		  
			<?php } ?>

		</tbody>
		</table>
		


				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Vaiko duomenys</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <form name="save_child" method="POST">
						  <div class="modal-body">
							<div class="row g-3 align-items-center">
							  <div class="col-2">
								<label for="name" class="col-form-label">Vardas</label>
							  </div>
							  <div class="col-6">
								<input type="text" id="name" name="child_name" class="form-control" aria-describedby="passwordHelpInline">
							  </div>
							</div>
						  </div>
						  <div class="modal-body">
							<div class="row g-3 align-items-center">
							  <div class="col-2">
								<label for="surname" class="col-form-label">Pavardė</label>
							  </div>
							  <div class="col-6">
								<input type="text" id="surname" name="child_surname" class="form-control" aria-describedby="passwordHelpInline">
							  </div>
							</div>
						  </div>
						  <div class="modal-body">
							<div class="row g-3 align-items-center">
							  <div class="col-2">
								<label for="group" class="col-form-label">Grupė</label>
							  </div>
								<div class="col-6">
									<select class="form-select" aria-label=".form-select-sm example" name="child_group_id">
									<?php
									while($group = mysqli_fetch_assoc($groups))
										{
											echo '<option selected value="'.$group['group_id'].'">'.$group['group_title'].'</option>';
										}
									?>
									</select>
								</div>
							  <div class="col-4">
								<button class="btn btn-success" type="button" name="" onclick="pop_up('groups.php?group_id=<?php  ?>')">Įvesti naują</button>
							  </div>
							</div>
						  </div>
						  <div class="modal-body">
							<div class="row g-3 align-items-center">
							  <div class="col-5">
								<label for="parents_email" class="col-form-label">Tevų e. pašto adresas</label>
							  </div>
							  <div class="col-7">
								<input type="email" id="parents_email" name="child_parents_email" class="form-control" aria-describedby="passwordHelpInline">
							  </div>
							</div>
						  </div>
						  <div class="modal-body">
							<div class="row g-3 align-items-center">
							  <div class="col-5">
								<label for="parents_telno" class="col-form-label">Tėvų telefono numeris</label>
							  </div>
							  <div class="col-7">
								<input type="text" id="parents_telno" name="child_parents_telno" class="form-control" aria-describedby="passwordHelpInline">
							  </div>
							</div>
						  </div>
						  <div class="modal-body">
							<div class="row g-3 align-items-center">
							  <div class="col-5">
								<label for="child_birthdate" class="col-form-label">Vaiko gimimo diena</label>
							  </div>
							  <div class="col-7">
								<input type="text" id="child_birthdate" name="child_birthdate" class="form-control" aria-describedby="passwordHelpInline">
							  </div>
							</div>
						  </div>						  
						  <div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Uždaryti</button>
							<button class="btn btn-success" type="submit" name="save_child">Saugoti</button>
						  </div>
					  </form>
					</div>
				  </div>
				</div>


		<script>
		function pop_up(url){
			window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=1000,height=600", true); 
		}
		</script>


	</div>
</div>
