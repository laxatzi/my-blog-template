<?php


// reduce back and forth changing of the same code while working in a local environment

if ($_SERVER['SERVER_NAME'] == 'localhost') {
  define('DBUSER', 'ROOT');
  define('DBPASS', "");
  define('DBNAME', "my_blog_db");
  define('DBHOST', 'localhost');

}else {
  define('DBUSER', 'ROOT');
  define('DBPASS', "");
  define('DBNAME', "my_blog_db");
  define('DBHOST', 'localhost');

}

