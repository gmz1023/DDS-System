<?php
include($_SERVER['DOCUMENT_ROOT'].'/includes/db.php');
$sql = "TRUNCATE votes; UPDATE subsystem SET status = 0";
try { $db->exec($sql);}catch(PDOException $e) { die($e->getMessage);}
