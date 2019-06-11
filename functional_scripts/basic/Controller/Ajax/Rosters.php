<?php
include('../../Config/Setup.php');
if(isset($_POST['type'])) {
    if($_POST['type'] == 'OPTIONS') {
		if(isset($_POST['houseId']) && isset($_POST['divisionId']) && isset($_POST['teamId'])) {
			$rosterOptions = getRosterOptions($_POST['houseId'], $_POST['divisionId'], $_POST['teamId']);
			$html = '<option> - Select a roster - </option>';
                            
            foreach($rosterOptions as $rosterId => $name) {
                $html .= '<option value="' . $rosterId . '">' . $name . '</option>';
            }

            $response = new stdClass();
            $response->html = $html;
			echo json_encode($response);
		}
	}
}
?>