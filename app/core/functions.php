<?php
  // create a function that creates tables | when function called it will make a db connection and run the tables that we need
  create_tables();

  function create_tables() {
	$str = "mysql:hostname=localhost;";
    $conn = new PDO($str, DBUSER, DBPASS);

// Create database

    $query = "CREATE DATABASE IF NOT EXISTS ".DBNAME;

    $stmt = $conn->prepare($query);
    $stmt->execute();

// Select the database to use

    $query = "use ". DBNAME;
	  $stm = $conn->prepare($query);
	  $stm->execute();

// Create tables

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

    // categories table
	$query = "CREATE TABLE IF NOT EXISTS categories(

		id int primary key auto_increment,
		category varchar(50) not null,
		slug varchar(100) not null,
		disabled tinyint default 0,

		key slug (slug),
		key category (category)

	)";
	$stm = $conn->prepare($query);
	$stm->execute();
  }