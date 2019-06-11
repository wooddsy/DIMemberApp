<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
//$appDir = getcwd();

include(getcwd() . '/Config/Setup.php');

$properties = new stdClass();
$properties->showMenu = true;

if(!isset($_SESSION['login'])) {
	$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
	$elements = explode('/', $path);                // Split path on slashes
	if($elements[3] == 'register') {
		$sitemap = getSitemap(2);
	}
	else {
		initiateLoginPage();
		$sitemap = getSitemap(1);
	}
	$page = $sitemap->path;

	$properties->showMenu = false;
}
else {
	
	$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
	$elements = explode('/', $path);                // Split path on slashes

	//echo '<pre>';
	//var_dump($elements[3]);
	//exit;
	
	if(isset($elements[3]) && $elements[3] == 'logout') {
		$sitemap = getSitemap(3);
		$page = $sitemap->path;
	}
	else {
		//$menu = getMenu();

		//echo '<pre>';
		//var_dump($elements);
		//exit;

		if( !isset($elements[3]) ||
			$elements[3] == '' ||
			$elements[3] == 'dashboard'
		) {
			$sitemap = getSitemap(4);
			$page = $sitemap->path;
		}
		elseif($elements[3] == 'members') {
			if(isset($elements[4]) && $elements[4] !== '') {
				if($elements[4] == 'details') {
					$sitemap = getSitemap(10);
					$page = $sitemap->path;
					$properties->static = array($elements[5] => $elements[6]);
				}
				elseif($elements[4] == 'edit') {
					$sitemap = getSitemap(11);
					$page = $sitemap->path;
					$properties->static = array($elements[5] => $elements[6]);
				}
				elseif($elements[4] == 'remove') {
					$sitemap = getSitemap(12);
					$page = $sitemap->path;
					$properties->static = array($elements[5] => $elements[6]);
					if(isset($elements[7]) && $elements[7] == 'confirmAction' && isset($elements[8]) && $elements[8] !== '') {
						$properties->static[$elements[7]] = $elements[8];
					}
				}
			}
			else {
				$sitemap = getSitemap(9);
				$page = $sitemap->path;
			}
		}
		elseif($elements[3] == 'houses') {
			if(isset($elements[4]) && $elements[4] !== '') {
				if($elements[4] == 'details') {
					$sitemap = getSitemap(14);
					$page = $sitemap->path;
					$properties->static = array($elements[5] => $elements[6]);
				}
				elseif($elements[4] == 'edit') {
					$sitemap = getSitemap(15);
					$page = $sitemap->path;
					$properties->static = array($elements[5] => $elements[6]);
				}
			}
			else {
				$sitemap = getSitemap(13);
				$page = $sitemap->path;
			}
		}
		elseif($elements[3] == 'divisions') {
			if(isset($elements[4]) && $elements[4] !== '') {
				if($elements[4] == 'details') {
					$sitemap = getSitemap(7);
					$page = $sitemap->path;
					$properties->static = array($elements[5] => $elements[6]);
				}
				elseif($elements[4] == 'edit') {
					$sitemap = getSitemap(8);
					$page = $sitemap->path;
					$properties->static = array($elements[5] => $elements[6]);
				}
			}
			else {
				$sitemap = getSitemap(6);
				$page = $sitemap->path;
			}
		}
		else {
			$sitemap = getSitemap();
			echo '<pre>';
			var_dump($sitemap);
			var_dump($elements);
			exit;
		}
	}
}

$properties->uri = $sitemap->uri;
$properties->title = $sitemap->title;
//


//if(empty($elements[0])) {                       // No path elements means home
//    $page = 'Login.php';
//} 
//else switch(array_shift($elements)) {             // Pop off first item and switch
//    case 'Some-text-goes-here':
//        ShowPicture($elements); // passes rest of parameters to internal function
//        break;
//    case 'more':
//        ...
//    default:
//        header('HTTP/1.1 404 Not Found');
//        Show404Error();
//}

renderPage($page, $properties);
?>