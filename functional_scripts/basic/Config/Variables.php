<?php
function setDiRanks()
{
	return array(
			4 => 'Leader',
			18 => 'General',
			41 => 'Commander',
			14 => 'Captain',
			79 => 'Warden',
			95 => 'Mentor',
			91 => 'Guardian',
			87 => 'Champion',
			10 => 'Companion',
			9 => 'Associate',
			3 => 'Initiate',
			94 => 'Inactive'
		);
}

function setDiStatusses()
{
	return array(
		'status' => array(
			'ACTIVE' => '<i class="fal fa-check"></i>',
			'INACTIVE' => '<i class="fal fa-times"></i>',
			'AWAY' => '<i class="fal fa-island-tropical"></i>'
		),
		'forum' => array(
			'ACTIVE' => '<i class="fal fa-check"></i>',
			'INACTIVE' => '<i class="fal fa-times"></i>',
			'WARNING' => '<i class="fal fa-exclamation-triangle"></i>'
		),
		'teamspeak' => array(
			'ACTIVE' => '<i class="fal fa-check"></i>',
			'INACTIVE' => '<i class="fal fa-times"></i>',
			'WARNING' => '<i class="fal fa-exclamation-triangle"></i>'
		)
	);
}
?>