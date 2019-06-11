<?php
include('../../Config/Setup.php');
if(isset($_POST['type'])) {
    if($_POST['type'] == 'OPTIONS') {
        if(isset($_POST['houseId'])) {
            $divisionOptions = getDivisionOptions($_POST['houseId']);
            $html = '<option> - Select a division - </option>';
                            
            foreach($divisionOptions as $divisionId => $name) {
                $html .= '<option value="' . $divisionId . '">' . $name . '</option>';
            }

            $response = new stdClass();
            $response->html = $html;
            
            echo json_encode($response);
        }
    }
}

?>