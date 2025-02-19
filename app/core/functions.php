<?php
  // create a function that creates tables | when function called it will make a db connection and run the tables that we need
  create_tables();

  function create_tables() {
    $string = "mysql:hostname=localhost;";
    $con = new PDO($string, DBUSER, DBPASS);

    print_r($con);
  }