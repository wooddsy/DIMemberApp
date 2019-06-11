<?php
$memberId = (isset($properties->static['memberId']) ? $properties->static['memberId'] : 'NEW');

if($memberId != 'NEW') {
	$dbInstance = getDbInstance();

	$query = "SELECT * FROM members WHERE memberId = '" . $memberId . "'";
	$member = $dbInstance->query($query)->fetch(PDO::FETCH_OBJ);
}

$houseOptions = getHouseOptions();
$divisionOptions = getDivisionOptions();
$teamOptions = getTeamOptions();
$rosterOptions = getRosterOptions();

$rankOptions = getDiRanks();
$statusOptions = getDiStatusses();

if(isset($_POST['updateMember']))
{
	$data = array(
		'diId' => $_POST['diId'],
		'diName' => $_POST['diName'],
		'diRank' => $_POST['diRank'],
		'houseId' => $_POST['houseId'],
		'divisionId' => $_POST['divisionId'],
		'teamId' => $_POST['teamId'],
		'rosterId' => $_POST['rosterId'],
		'diReputation' => $_POST['diReputation'],
		'diPostCount' => $_POST['diPostCount'],
		'diStatus' => $_POST['statusStatus'],
		'diForumActivity' => $_POST['forumStatus'],
		'diTeamSpeakActivity' => $_POST['teamspeakStatus'],
	);

    $dbInstance = getDbInstance();

	$query = "SELECT * FROM members WHERE diId = '" . $data['diId'] . "'";
	$member = $dbInstance->query($query)->fetch(PDO::FETCH_OBJ);

	if($memberId != 'NEW') {
		$data['memberId'] = $memberId;

		$update = "UPDATE members SET houseId=:houseId, divisionId=:divisionId, teamId=:teamId, rosterId=:rosterId, diId=:diId, diName=:diName, diRank=:diRank, diReputation=:diReputation, diPostCount=:diPostCount, diForumActivity=:diForumActivity, diTeamSpeakActivity=:diTeamSpeakActivity, diStatus=:diStatus WHERE memberId=:memberId";
		$stmt = $dbInstance->prepare($update);
		
		$stmt->execute($data);

		$_SESSION['succesMessage'] = 'The member has been updated succesfully';
		echo "<script>window.location = 'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members';</script>";
	}
	elseif($memberId == 'NEW' && !$member) {

		$query = "INSERT INTO members (houseId, divisionId, teamId, rosterId, diId, diName, diRank, diReputation, diPostCount, diForumActivity, diTeamSpeakActivity, diStatus) VALUES (:houseId, :divisionId, :teamId, :rosterId, :diId, :diName, :diRank, :diReputation, :diPostCount, :diForumActivity, :diTeamSpeakActivity, :diStatus)";

		$dbInstance->prepare($query)->execute($data);

		/*try {
		    $pdo->prepare("INSERT INTO users VALUES (NULL,?,?,?,?)")->execute($data);
		} catch (PDOException $e) {
		    $existingkey = "Integrity constraint violation: 1062 Duplicate entry";
		    if (strpos($e->getMessage(), $existingkey) !== FALSE) {
		
		        // Take some action if there is a key constraint violation, i.e. duplicate name
		    } else {
		        throw $e;
		    }
		}*/

		$_SESSION['succesMessage'] = 'The member has been added succesfully';
		echo "<script>window.location = 'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members';</script>";
	}
	elseif($memberId == 'NEW' && $member) {
		$_SESSION['errorMessage'] = 'The member that you are trying to add already exists';
	}

    //echo '<pre>';
    //var_dump($data);
    //echo '</pre>';
}

$userId = 34451;
$apiUrl = 'https://api.dmg-inc.com/user/fetch/';
$apiCallMethod = 'GET';

//$response = getApiResponse($apiCallMethod, $apiUrl . $userId);
//echo '<pre>';
//print_r($response);
//echo '</pre>';
//exit;

?>
<div class="custom-content-wrapper">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h1>DI Member edit form</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-lg-6">
			<p>Please fill in or edit this form to add or edit a member from DI</p>
		</div>
	</div>
	<?php 
		if(isset($_SESSION['successMessage'])) {
			echo '<div class="row">';
				echo '<div class="col-sm-12 col-md-12 col-lg-12">';
					echo '<div class="alert alert-success" role="alert"><i class="fal fa-thumbs-up"></i>&nbsp;' . $_SESSION['successMessage'] . '</div>';
				echo '</div>';
			echo '</div>';
			unset($_SESSION['successMessage']);
		}
		elseif(isset($_SESSION['errorMessage'])) {
			echo '<div class="row">';
				echo '<div class="col-sm-12 col-md-12 col-lg-12">';
					echo '<div class="alert alert-danger" role="alert"><i class="fal fa-thumbs-down"></i>&nbsp;' . $_SESSION['errorMessage'] . '</div>';
				echo '</div>';
			echo '</div>';
			unset($_SESSION['errorMessage']);
		}
	?>

	<form name="editMember" action="" method="post" id="editMemberForm">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="diName">DI Name</label>
						<input type="text" class="form-control" id="diName" name="diName" placeholder="DI Username" title="The username used on the DI forums" <?php echo (isset($member->memberId) && $member->diName !== null ? 'value="' . $member->diName . '"' : '');?>>
					</div>
					<div class="form-group col-md-4">
						<label for="diId">DI Id</label>
						<input type="text" class="form-control" id="diId" name="diId" placeholder="DI User id" title="The userId used on the DI forums. Can be found by navigating to a member's profile and copying the number in front of the username in the url." <?php echo (isset($member->memberId) && $member->diId !== null ? 'value="' . $member->diId . '"' : '');?>>
					</div>
					<div class="form-group col-md-2">
						<div class="btn btn-info" style="margin-top: 32px;" id="getDiData" onclick="$.requestDiMemberData($('#diId').val());">Get from DI</div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="diRank">Rank</label>
						<select class="form-control" id="diRank" name="diRank">
							<option> - Select a rank - </option>
							<?php
								foreach($rankOptions as $rankId => $name) {
									$selected = '';
									if($memberId !== 'NEW' && $member->diRank !== null && $member->diRank == $rankId) {
										$selected = 'selected';
									}
									echo '<option value="' . $rankId . '" ' . $selected . '>' . $name . '</option>';
								}
							?>
						</select>
					</div>
				</div>
			
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="houseId">House</label>
						<select class="form-control" id="houseId" name="houseId" onchange="$.getDivisionOptions(this.value);">
							<option> - Select a house - </option>
							<?php
								foreach($houseOptions as $houseId => $name) {
									$selected = '';
									if($memberId !== 'NEW' && $member->houseId !== null && $member->houseId == $houseId) {
										$selected = 'selected';
									}
									echo '<option value="' . $houseId . '" ' . $selected . '>' . $name . '</option>';
								}
							?>
						</select>
					</div>
				</div>
			
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="divisionId">Division</label>
						<select class="form-control" id="divisionId" name="divisionId" onchange="$.getTeamOptions($('#houseId').val(), this.value);">
							<!--<option> - Select a division - </option>-->
							<?php
							//	foreach($divisionOptions as $divisionId => $name) {
							//		$selected = '';
							//		if($memberId !== 'NEW' && $member->divisionId !== null && $member->divisionId == $divisionId) {
							//			$selected = 'selected';
							//		}
							//		echo '<option value="' . $divisionId . '" ' . $selected . '>' . $name . '</option>';
							//	}
							?>
						</select>
					</div>
				</div>
			
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="teamId">Team</label>
						<select class="form-control" id="teamId" name="teamId" onchange="$.getRosterOptions($('#houseId').val(), $('#divisionId').val(), this.value);">
							<!--<option> - Select a team - </option>-->
							<?php
							//	foreach($teamOptions as $teamId => $name) {
							//		$selected = '';
							//		if($memberId !== 'NEW' && $member->teamId !== null && $member->teamId == $teamId) {
							//			$selected = 'selected';
							//		}
							//		echo '<option value="' . $teamId . '" ' . $selected . '>' . $name . '</option>';
							//	}
							?>
						</select>
					</div>
				</div>
			
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="rosterId">Roster</label>
						<select class="form-control" id="rosterId" name="rosterId">
							<!--<option> - Select a roster - </option>-->
							<?php
							//	foreach($rosterOptions as $rosterId => $name) {
							//		$selected = '';
							//		if($memberId !== 'NEW' && $member->rosterId !== null && $member->rosterId == $rosterId) {
							//			$selected = 'selected';
							//		}
							//		echo '<option value="' . $rosterId . '" ' . $selected . '>' . $name . '</option>';
							//	}
							?>
						</select>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-6">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="diReputation">Reputation</label>
						<input type="text" class="form-control" id="diReputation" name="diReputation" placeholder="Reputation" title="The reputation of the user on DI" <?php echo (isset($member->memberId) && $member->diReputation !== null ? 'value="' . $member->diReputation . '"' : '');?>>
					</div>
					<div class="form-group col-md-6">
						<label for="diPostCount">Post count</label>
						<input type="text" class="form-control" id="diPostCount" name="diPostCount" placeholder="Post count" title="The post count of the user on DI" <?php echo (isset($member->memberId) && $member->diPostCount !== null ? 'value="' . $member->diPostCount . '"' : '');?>>
					</div>
				</div>

				<?php
					$html = '';
					foreach($statusOptions as $type => $options) {
						$html .= '<div class="form-row">';
							$html .= '<div class="form-group col-md-12">';
								$html .= '<div class="col-md-4">';
									$html .= '<label for="' . $type . 'Status">' . ucfirst($type) . '</label>';
								$html .= '</div>';
								$html .= '<div class="col-md-8">';
								foreach($options as $value => $status) {
									$checked = '';
									if($memberId !== 'NEW' && 
										(
											($type == 'status' && $member->diStatus !== null && $member->diStatus == $value) ||
											($type == 'forum' && $member->diForumActivity !== null && $member->diForumActivity == $value) ||
											($type == 'teamspeak' && $member->diTeamSpeakActivity !== null && $member->diTeamSpeakActivity == $value)
										)
									) {
										$checked = 'checked';
									}
									$html .= '<div class="form-check form-check-inline">';
										$html .= '<input class="form-check-input" type="radio" name="' . $type . 'Status" id="' . $type . 'Status' . $value . '" value="' . $value . '" ' . $checked . '>';
										$html .= '<label class="form-check-label" for="' . $type . 'Status">' . $status . '</label>';
									$html .= '</div>';
								}
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</div>';
					}
					echo $html;
				?>
			</div>
		</div>
		<div class="btn btn-danger col-md-1 offset-md-9" id="cancel" onclick="window.location.replace('http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members');">Cancel</div>
		<button type="submit" name="updateMember" value="updateMember" class="btn btn-primary col-md-1">Save</button>
	</form>
</div>