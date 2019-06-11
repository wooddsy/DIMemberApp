<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include('Api.php');
include('Database.php');

function getDbInstance()
{
	return setDbInstance();
}

function getSitemap($nodeId = null)
{
	if($nodeId != null) {
		return setSitemap($nodeId);
	}
	else {
		$sitemap = setSitemap();
		$sitemapLevels = array();
		foreach($sitemap as $row) {
			$sitemapLevels[$row->level][$row->uri] = $row;
		}
		return $sitemapLevels;
	}
}

function getMenu()
{
	$menuRows = setMenu();
	$menuLevels = array();
	$menuItems = array();
	$menuMap = array();
	
	foreach($menuRows as $row) {
		$menuItems[$row->nodeId] = $row;
		$menuLevels[$row->level][$row->nodeId] = $row;
	}

	//TODO: MORE THAN 2 LEVEL SUPPORT
	$levelI = 1;
	while($levelI <= count($menuLevels)) {
		$menuLevel = $menuLevels[$levelI];
		foreach($menuLevels[$levelI] as $nodeId => $item) {
			if($levelI === 1 && !isset($menuMap[$nodeId])) {
				$menuMap[$nodeId] = array();
			}
			else {
				$menuMap[$item->parentId] = $nodeId;
			}
		}

		$levelI++;
	}

	$menu = new stdClass();
	$menu->items = $menuItems;
	$menu->map = $menuMap;
	return $menu;
}

include('Authenticate.php');

function getActivationCode()
{
	return setActivationCode();
}

function buildMenu($type)
{
	if($type === 'LEFT') {

	}
}

function renderPage($page = 'Login.php', $properties)
{
	$appDir = '/di_tools/functional_scripts/basic';
	include(getcwd() . '/Header.php');
	include(getcwd() . '/View/' . $page);
	include(getcwd() . '/Footer.php');
}

include('Variables.php');

function getDiRanks()
{
	return setDiRanks();
}

function getDiStatusses()
{
	return setDiStatusses();
}

function getHouseOptions()
{
	$dbInstance = getDbInstance();
    $select = 'SELECT houseId, name ';
    $from = 'FROM houses ';
    $where = '';
    $order = 'ORDER BY sort';
    $query = $select . $from . $where . $order;

    $result = $dbInstance->query($query)->fetchAll(PDO::FETCH_KEY_PAIR);

    return $result;
}

function getDivisionOptions($houseId = null)
{
	$dbInstance = getDbInstance();
    $select = 'SELECT divisionId, name ';
    $from = 'FROM divisions ';
    $where = '';
    if($houseId !== null) {
    	$where .= "WHERE houseId = '" . $houseId . "' ";
    }
    $order = 'ORDER BY sort';
    $query = $select . $from . $where . $order;

    $result = $dbInstance->query($query)->fetchAll(PDO::FETCH_KEY_PAIR);

    return $result;
}

function getTeamOptions($houseId = null, $divisionId = null)
{
	$dbInstance = getDbInstance();
    $select = 'SELECT teamId, name ';
    $from = 'FROM teams ';
    $where = '';

    if($houseId !== null) {
    	$where .= "WHERE houseId = '" . $houseId . "' ";
    }

    if($houseId !== null && $divisionId !== null) {
    	$where .= "AND divisionId = '" . $divisionId . "' ";
    }
    elseif($houseId == null && $divisionId !== null) {
    	$where .= "WHERE divisionId = '" . $divisionId . "' ";
    }

    $order = 'ORDER BY sort';
    $query = $select . $from . $where . $order;

    $result = $dbInstance->query($query)->fetchAll(PDO::FETCH_KEY_PAIR);

    return $result;
}

function getRosterOptions($houseId = null, $divisionId = null, $teamId = null)
{
	$dbInstance = getDbInstance();
    $select = 'SELECT rosterId, name ';
    $from = 'FROM rosters ';
    $where = '';

    if($houseId !== null) {
    	$where .= "WHERE houseId = '" . $houseId . "' ";
    }

    if($houseId !== null && $divisionId !== null) {
    	$where .= "AND divisionId = '" . $divisionId . "' ";
    }
    elseif($houseId == null && $divisionId !== null) {
    	$where .= "WHERE divisionId = '" . $divisionId . "' ";
    }

    if(($houseId !== null || $divisionId !== null) && $teamId !== null) {
    	$where .= "AND teamId = '" . $teamId . "' ";
    }
    elseif($houseId == null && $divisionId == null && $teamId !== null) {
    	$where .= "WHERE teamId = '" . $teamId . "' ";
    }

    $order = 'ORDER BY sort';
    $query = $select . $from . $where . $order;

    $result = $dbInstance->query($query)->fetchAll(PDO::FETCH_KEY_PAIR);

    return $result;
}
?>