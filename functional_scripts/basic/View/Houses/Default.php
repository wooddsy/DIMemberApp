<?php
	$dbInstance = getDbInstance();
    $select = 'SELECT h.* ';
    $from = 'FROM houses h ';
    $where = '';
    $order = 'ORDER BY sort';
    $query = $select . $from . $where . $order;

    $houses = $dbInstance->query($query)->fetchAll(PDO::FETCH_OBJ);

    //echo '<pre>';
    //var_dump($diRanks);
    //var_dump($members);
    //exit;
?>
<div class="custom-content-wrapper">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h1>DI Houses overview</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<p>The table down below shows all the houses added to the current database. New houses need to be added by an admin.</p>
		</div>
	</div>
	<!--<div class="row mb-2">
		<div class="col-sm-12 col-md-12 col-lg-6">
			<div id="newMemberButton" class="di-button" title="Add a new member" onclick="window.location.replace('http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members/edit/memberId/NEW/');">
				<i class="fal fa-user-plus fa-2x"></i>
			</div>
		</div>
	</div>-->
	
	<?php 
		if(isset($_SESSION['successMessage'])) {
			echo '<div class="row mb-2">';
				echo '<div class="col-sm-12 col-md-12 col-lg-12">';
					echo '<div class="alert alert-success" role="alert"><i class="fal fa-thumbs-up"></i>&nbsp;' . $_SESSION['successMessage'] . '</div>';
				echo '</div>';
			echo '</div>';
			unset($_SESSION['successMessage']);
		}
		elseif(isset($_SESSION['errorMessage'])) {
			echo '<div class="row mb-2">';
				echo '<div class="col-sm-12 col-md-12 col-lg-12">';
					echo '<div class="alert alert-danger" role="alert"><i class="fal fa-thumbs-down"></i>&nbsp;' . $_SESSION['errorMessage'] . '</div>';
				echo '</div>';
			echo '</div>';
			unset($_SESSION['errorMessage']);
		}
	?>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col"></th>
					  	<th scope="col">House</th>
					  	<th scope="col">House General</th>
					  	<th scope="col">First Commander</th>
					  	<th scope="col" width="20"  style="text-align: center;"></th>
					  	<th scope="col" width="20"  style="text-align: center;"></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$rows = '';
						foreach($houses as $house) {
							$row = '<tr>';
							$row .= '<td width="30" style="padding: 0!important;"><img src="' . $house->imageUrl . '" class="di-house-table-icon"></td>';
							$row .= '<td>' . $house->name . '</td>';
							$row .= '<td>' . ($house->general != null ? $house->general : '') . '</td>';
							$row .= '<td>' . ($house->firstCommander != null ? $house->firstCommander : '') . '</td>';
							$row .= '<td width="20" style="text-align: center;"><i class="fal fa-home-lg-alt di-table-row-button" title="Edit this member" onclick="window.location.replace(\'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/houses/details/houseId/' . $house->houseId . '/\');"></i></td>';
							$row .= '<td width="20" style="text-align: center;"><i class="fal fa-pen di-table-row-button" title="Remove this member" onclick="window.location.replace(\'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/houses/edit/houseId/' . $house->houseId . '/\');"></i></td>';
							$row .= '</tr>';
							$rows .= $row;
						}
						echo $rows;
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>