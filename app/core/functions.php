<?php


// run Database-queries function
 function db_query(string $query, array $data = []) {
	$str = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
    $conn = new PDO($str, DBUSER, DBPASS);

// Create database

    $query = "CREATE DATABASE IF NOT EXISTS ".DBNAME;

    $stmt = $conn->prepare($query);
    $stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (is_array($result) && !empty($result)) {
			return $result;
		}
    return false;
 }

  // create a function that creates tables | when function called it will make a db connection and run the tables that we need

 // No need to keep running provided that we have already created the necessary tables. So we just mute the calling function (//)
 // create_tables();

  function create_tables() {
	$str = "mysql:hostname=".DBHOST.";";
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


  /** posts table **/
	$query = "CREATE TABLE IF NOT EXISTS posts(

		id int primary key auto_increment,
		user_id int,
		category_id int,
		title varchar(100) not null,
		content text null,
		image varchar(1024) null,
		date datetime default current_timestamp,
		slug varchar(100) not null,

		key user_id (user_id),
		key category_id (category_id),
		key title (title),
		key slug (slug),
		key date (date)

	)";
	$stm = $conn->prepare($query);
	$stm->execute();
  }