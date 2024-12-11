<?php
// Get everything from postal codes
$queryPostalCode = $dbCon->prepare("SELECT * FROM PostalCode");
$queryPostalCode->execute();
$getPostalCode = $queryPostalCode->fetchAll();