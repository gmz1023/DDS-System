<?php
session_start();
if(!isset($max))
{
	$max = 9999; // Unending Essentially
}
if(!isset($_SESSION['tracker']))
   {
	   $_SESSION['tracker'] = 1;
   }
   else
   {
	   $_SESSION['tracker'] = $_SESSION['tracker']+1;
	   if($_SESSION['tracker'] >= $max)
	   {
		   $_SESSION['tracker'] = 1;
	   }
   }