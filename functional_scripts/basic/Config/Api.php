<?php
// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function callApi($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function getApiResponse($method, $url, $data = false)
{
	$response = callApi($method, $url, $data);
	return json_decode($response);
}

//echo callApi('GET','https://api.dmg-inc.com/user/fetch/34451');

if(isset($_POST['callType'])) {
	if($_POST['callType'] == 'SIMPLE') {
		$callMethod = $_POST['callMethod'];
		$callUrl = $_POST['callUrl'];

		$response = callApi($callMethod, $callUrl);
		echo $response;
		//echo 'Hey! We have a simple response!';
	}
}
?>