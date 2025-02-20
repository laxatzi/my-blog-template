<?php
  // create a function that creates tables | when function called it will make a db connection and run the tables that we need
  create_tables();

  function create_tables() {
	$str = "mysql:hostname=localhost;";
    $conn = new PDO($str, DBUSER, DBPASS);

    $query = "create database if not exists ".DBNAME;

    $stm = $conn->prepare($query);
    $stm->execute();
  }