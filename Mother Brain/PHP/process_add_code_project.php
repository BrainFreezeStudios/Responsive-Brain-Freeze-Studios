<?php
require_once 'session.php';
require_once 'code_functions.php';

if(login_check($mysqli) == false)
{
	die('<meta http-equiv="refresh" content="0;url=http://www.brainfreezstudios.com">');
}
else
{
	if(check_admin($mysqli) == true)
	{
		if(isset($_POST['title'],$_POST['description'],$_POST['url'],$_POST['logo'],$_POST['license']))
		{
			$titel = $_POST['title'];
			
			addCodeProject($mysqli,$title);
		}		
	}
	else
	{
	}
}
?>
