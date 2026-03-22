<?php


  $db_config =  require_once 'db.php';

  
  require_once 'classes/Db.php';
  require_once 'classes/Pagination.php'; 
  require_once 'functions.php';

 
  $db = (Db::getInstance())->getConnection($db_config['db']);  
  
  $total = get_count_t('city');

  $per_page = $db_config['per_page'];

  $curr_page = $_GET['page'] ?? 1;




  $pagination = new myframew\Pagination($total, $per_page, $curr_page);
  $start = $pagination->getStart();


  $cities = get_cities($start, $per_page);

  // echo '<pre>';
  // print_r($cities);
  // echo '</pre>';

require_once 'views/index.tpl.php';


