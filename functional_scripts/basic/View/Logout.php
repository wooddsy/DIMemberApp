<?php
session_start();
$_SESSION['login']=="";
session_unset();
$_SESSION['action1']="You have logged out successfully..!";
?>
<script language="javascript">
window.location.replace('http://projects.subatomisch.nl/di_tools/functional_scripts/basic/');
</script>
