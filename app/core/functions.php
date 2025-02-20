<?php
  // create a function that creates tables | when function called it will make a db connection and run the tables that we need
  create_tables();

  function create_tables() {
	$str = "mysql:hostname=localhost;";
    $conn = new PDO($str, DBUSER, DBPASS);

    $query = "CREATE DATABASE IF NOT EXISTS ".DBNAME;

    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Create tables

    $query = "use ". DBNAME;
	  $stm = $conn->prepare($query);
	  $stm->execute();

    // Users table
    $query = "CREATE TABLE IF NOT EXISTS users(
      id int primary key auto_increment,
		  username varchar(50) not null,
		  email varchar(100) not null,
		  password varchar(255) not null,
		  image varchar(1024) null,
		  date datetime default current_timestamp,
		  role varchar(10) not null,

		  key username (username),
		  key email (email)

    )";

    $stmt = $conn->prepare($query);
    $stmt->execute();
  }