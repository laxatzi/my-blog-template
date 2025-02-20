<?php


// while we work back and forth on a local environment we cannot redefine constants so we set them once for each environment.

if ($_SERVER['SERVER_NAME'] == 'localhost') {
  define('DBUSER', 'root');
  define('DBPASS', '');
  define('DBNAME', 'my_blog_db');
  define('DBHOST', 'localhost');

}else {
  define('DBUSER', 'root');
  define('DBPASS', '');
  define('DBNAME', 'my_blog_db');
  define('DBHOST', 'localhost');

}

