<?php
$memberId = (isset($properties->static['memberId']) ? $properties->static['memberId'] : 'NEW');
$confirmAction = (isset($properties->static['confirmAction']) ? $properties->static['confirmAction'] : null);

$dbInstance = getDbInstance();

$query = "SELECT * FROM members WHERE memberId = '" . $memberId . "'";
$member = $dbInstance->query($query)->fetch(PDO::FETCH_OBJ);

if($confirmAction === 'delete') {
	$stmt = $dbInstance->prepare("DELETE FROM members WHERE memberId = :memberId");
	$stmt->execute(array('memberId' => $memberId));

	$_SESSION['succesMessage'] = 'The member has been removed succesfully';
	echo "<script>window.location = 'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members';</script>";
}

$houseOptions = getHouseOptions();
$divisionOptions = getDivisionOptions();
$teamOptions = getTeamOptions();
$rosterOptions = getRosterOptions();

$rankOptions = getDiRanks();
$statusOptions = getDiStatusses();

$html = '';
$html .= '<div class="custom-content-wrapper">';
    $html .= '<div class="row">';
        $html .= '<div class="col-sm-12 col-md-12 col-lg-12">';
            $html .= '<div class="alert alert-danger" role="alert">';
            	$html .= '<h1>Remove DI member</h1>';
            	$html .= '<p>Are you sure that you want to remove this member? This action can not be undone!</p>';
        	$html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';

    $html .= '<div class="row mb-4">';
        $html .= '<div class="col-sm-12 col-md-12 col-lg-6">';
            $html .= '<div id="cancelButton" class="di-button" title="Return to overview" onclick="window.location.replace(\'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members/\');">';
                $html .= '<i class="fal fa-arrow-left fa-2x"></i>';
            $html .= '</div>';
            $html .= '<div id="confirmRemoveMemberButton" class="di-button" title="Remove this member" onclick="window.location.replace(\'http://projects.subatomisch.nl/di_tools/functional_scripts/basic/members/remove/memberId/' . $memberId . '/confirmAction/delete/\');">';
                $html .= '<i class="fal fa-user-slash fa-2x"></i>';
            $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';

    $html .= '<div class="row">';
        $html .= '<div class="col-sm-12 col-md-12 col-lg-12">';
            $html .= '<table class="table table-bordered"><tbody>';
                $html .= '<tr>';
                    $html .= '<th scope="row">DI Name</th>';
                    $html .= '<td>' . $member->diName . '</td>';
                    $html .= '<th scope="row">Reputation</th>';
                    $html .= '<td>' . $member->diReputation . '</td>';
                $html .= '</tr>';
            
                $html .= '<tr>';
                    $html .= '<th scope="row">DI Id</th>';
                    $html .= '<td>' . $member->diId . '</td>';
                    $html .= '<th scope="row">Post count</th>';
                    $html .= '<td>' . $member->diPostCount . '</td>';
                $html .= '</tr>';
            
                $html .= '<tr>';
                    $html .= '<th scope="row">House</th>';
                    $html .= '<td>' . $houseOptions[$member->houseId] . '</td>';
                    $html .= '<th scope="row">Status</th>';
                    $html .= '<td>' . $statusOptions['status'][$member->diStatus] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                    $html .= '<th scope="row">Division</th>';
                    $html .= '<td>' . $divisionOptions[$member->divisionId] . '</td>';
                    $html .= '<th scope="row">Forum activity</th>';
                    $html .= '<td>' . $statusOptions['forum'][$member->diForumActivity] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                    $html .= '<th scope="row">Team</th>';
                    $html .= '<td>' . ($member->teamId != null ? $teamOptions[$member->teamId] : '') . '</td>';
                    $html .= '<th scope="row">TeamSpeak activity</th>';
                    $html .= '<td>' . $statusOptions['teamspeak'][$member->diTeamSpeakActivity] . '</td>';
                $html .= '</tr>';
                $html .= '<tr>';
                    $html .= '<th scope="row">Roster</th>';
                    $html .= '<td>' . ($member->rosterId != null ? $rosterOptions[$member->rosterId] : '') . '</td>';
                $html .= '</tr>';
            $html .= '</tbody></tabel>';
        $html .= '</div>';
    $html .= '</div>';
$html .= '</div>';

echo $html;
?>