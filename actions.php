<?php

  $db_config =  require_once 'db.php';

  
  require_once 'classes/Db.php';
  require_once 'classes/Pagination.php'; 
  require_once 'classes/Validator.php'; 

  require_once 'functions.php';

 
  $db = (Db::getInstance())->getConnection($db_config['db']);


  $data = json_decode(file_get_contents('php://input'), true);

if(isset($data['page'])){

  $page = $data['page'];

  $total = get_count_t('city');

  $per_page = $db_config['per_page'];


  $pagination = new myframew\Pagination($total, $per_page, $page);
  $start = $pagination->getStart();

  $cities = get_cities($start, $per_page);

  require_once 'views/index-content.tpl.php';

  die;

};


if(isset($_POST['addCity'])){

  $dataForm = $_POST;

  $validation = new Validator();

  $validation->validate($dataForm, [

    'name' => ['required' =>true],
    'population' => ['minNum' =>1]

  ]);


  if($validation->hasErrors()){

    $errors = '<ul class="list-unstyled text-start text-danger">';

    foreach($validation->getErrors() as $nameError){

        foreach($nameError as $valueError){
          $errors.="<li>$valueError</li>";
        }

    }

    $errors.='<ul>';

    $result = ['answer' =>'error', 'errors' =>$errors];

    
  }  else{


    $result = ['answer' => 'success'];

  }

  echo json_encode($result);
  die;


}


