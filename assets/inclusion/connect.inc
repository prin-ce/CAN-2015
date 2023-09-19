<?php
	function connect()
	{
		$idc=mysqli_connect('localhost','root','Emmanuel242','bd_can');
		return($idc);
	}
?>