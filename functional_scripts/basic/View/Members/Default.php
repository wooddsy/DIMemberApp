<?php
	$dbInstance = getDbInstance();
    $select = 'SELECT m.*, h.name AS houseName, d.name AS divisionName, t.name AS teamName, r.name AS rosterName ';
    $from = 'FROM members m ';
    $join = 'JOIN houses h ON h.houseId = m.houseId ';
    $join .= 'JOIN divisions d ON d.divisionId = m.divisionId ';
    $join .= 'LEFT OUTER JOIN teams t ON t.teamId = m.teamId ';
    $join .= 'LEFT OUTER JOIN rosters r ON r.rosterId = m.rosterId ';
    $where = '';
    $order = 'ORDER BY houseName, divisionName, teamName, rosterName, m.sort';
    $query = $select . $from . $join . $where . $order;

    $members = $dbInstance->query($query)->fetchAll(PDO::FETCH_OBJ);

    $diRanks = getDiRanks();
    $diStatusses = getDiStatusses();

    //echo '<pre>';
    //var_dump($diRanks);
    //var_dump($members);
    //exit;
?>

<div class="custom-content-wrapper">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h1>DI Members overview</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<p>The table down below shows all the members added to the current database. Add a new member by clicking the button below.</p>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-sm-12 col-md-12 col-lg-6">
			<div id="newMemberButton" class="di-button" title="Add a new member" onclick="window.location.replace('http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members/edit/memberId/NEW/');">
				<i class="fal fa-user-plus fa-2x"></i>
			</div>
		</div>
	</div>
	
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
					  	<th scope="col">House</th>
					  	<th scope="col">Division</th>
					  	<th scope="col">Team</th>
					  	<th scope="col">Roster</th>
					  	<!--<th scope="col"><img src="/di_tools/functional_scripts/basic/View/img/logos/brand/main/main-dark-red.png" class="di-icon-25"></th>-->
					  	<th scope="col">Name</th>
					  	<th scope="col">Id</th>
					  	<th scope="col">Rank</th>
					  	<!--<th scope="col">DI Reputation</th>
					  	<th scope="col">DI Post count</th>-->
					  	<th scope="col" width="30" style="text-align: center;">Status</th>
					  	<!--<th scope="col">DI Forum activity</th>
					  	<th scope="col">DI Teamspeak activity</th>-->
					  	<th scope="col" width="20"  style="text-align: center;"><img src="/di_tools/functional_scripts/basic/View/img/logos/brand/main/main-dark-red.png" class="di-icon-25"></th>
					  	<th scope="col" width="20"  style="text-align: center;"><i class="fab fa-teamspeak"></i></th>
					  	<th scope="col" width="20"  style="text-align: center;"></th>
					  	<th scope="col" width="20"  style="text-align: center;"></th>
					  	<th scope="col" width="20"  style="text-align: center;"></th>
					  	<th scope="col" width="20"  style="text-align: center;"></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$rows = '';
						foreach($members as $member) {
							$row = '<tr>';
							$row .= '<td>' . $member->houseName . '</td>';
							$row .= '<td>' . $member->divisionName . '</td>';
							$row .= '<td>' . ($member->teamName != null ? $member->teamName : '') . '</td>';
							$row .= '<td>' . ($member->rosterName != null ? $member->rosterName : '') . '</td>';
							//$row .= '<td></td>';
							$row .= '<td>' . $member->diName . '</td>';
							$row .= '<td>' . $member->diId . '</td>';
							$row .= '<td>' . (isset($diRanks[$member->diRank]) ? $diRanks[$member->diRank] : 'Unknown (' . $member->diRank . ')') . '</td>';
							//$row .= '<td>' . $member->diReputation . '</td>';
							//$row .= '<td>' . $member->diPostCount . '</td>';
							$row .= '<td width="30" style="text-align: center;">' . $diStatusses['status'][$member->diStatus] . '</td>';
							$row .= '<td width="20" style="text-align: center;">' . $diStatusses['forum'][$member->diForumActivity] . '</td>';
							$row .= '<td width="20" style="text-align: center;">' . $diStatusses['teamspeak'][$member->diTeamSpeakActivity] . '</td>';
							$row .= '<td width="20" style="text-align: center;"><i class="fal fa-user di-table-row-button" title="Member details"  onclick="window.location.replace(\'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members/details/memberId/' . $member->memberId . '/\');"></i></td>';
							$row .= '<td width="20" style="text-align: center;"><i class="fal fa-user-edit di-table-row-button" title="Edit this member" onclick="window.location.replace(\'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members/edit/memberId/' . $member->memberId . '/\');"></i></td>';
							$row .= '<td width="20" style="text-align: center;"><i class="fal fa-user-slash di-table-row-button" title="Remove this member" onclick="window.location.replace(\'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members/remove/memberId/' . $member->memberId . '/\');"></i></td>';
							$row .= '<td width="20" style="text-align: center;"><i class="fal fa-sync di-table-row-button" title="Refresh member data"></i></td>';
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