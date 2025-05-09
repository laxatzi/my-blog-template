<?php
  session_start();

  // init is the only file we require here.
  require "../app/core/init.php";

  $url = $_GET['url'] ?? 'home';
  $url = strtolower($url);
  $url = explode('/', $url);

  $page_name = trim($url[0]);
  $filename = "../app/pages/".$page_name.".php";

  if (file_exists($filename)) {
     require_once $filename;
  } else {
    require_once "../app/pages/404.php";
  }


