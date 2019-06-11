<?php
include('../../Config/Setup.php');
if(isset($_POST['type'])) {
    if($_POST['type'] == 'OPTIONS') {
		if(isset($_POST['houseId']) && isset($_POST['divisionId'])) {
			$teamOptions = getTeamOptions($_POST['houseId'], $_POST['divisionId']);
			$html = '<option> - Select a team - </option>';
                            
            foreach($teamOptions as $teamId => $name) {
                $html .= '<option value="' . $teamId . '">' . $name . '</option>';
            }

            $response = new stdClass();
            $response->html = $html;
			echo json_encode($response);
		}
	}
}
?>