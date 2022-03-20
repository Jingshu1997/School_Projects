<?php
session_start();

if(isset($_SESSION["diff"]))
{
	$difficulte = $_SESSION["diff"];
}

echo json_encode($difficulte);