<?php

  $db_config =  require_once 'db.php';
 
  require_once 'classes/Db.php';
  require_once 'classes/Pagination.php'; 
  require_once 'classes/Validator.php'; 
  require_once 'functions.php';

 
  $db = (Db::getInstance())->getConnection($db_config['db']);


  $data = json_decode(file_get_contents('php://input'), true);

  // pagination

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




//  add city

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

    $errors.='</ul>';

    $result = ['answer' =>'error', 'errors' =>$errors];

    
  }  else{


    $result = ['answer' => 'success'];
    
    add_city($dataForm['name'], $dataForm['population']);

  }

  echo json_encode($result);
  die;


}

// get city for edit

if(isset($data['action']) && $data['action'] =='get_city'){

  $id = isset($data['id']) ? intval($data['id']) : 0;

  $rowCity = $db->query("SELECT * FROM city WHERE id = ?", [$id])->find();

  if($rowCity){

    $res = ['answer' => 'success', 'rowCity' => $rowCity];

  } else {

      $res = ['answer' =>'error'];
  }

  echo json_encode($res);

  die;

}


// delete city

if(isset($data['action']) && $data['action'] =='delete_city'){

  $id = isset($data['id']) ? intval($data['id']) : 0;

  $res = $db->query("DELETE FROM city WHERE id = ?", [$id]);

  if($res){

    $result = ['answer' => 'success'];

  } else{

    $result = ['answer' =>'error'];
  }

   echo json_encode($result);
  die;





}



//  edit city

if(isset($_POST['editCity'])) {

  $dataForm = $_POST;

  $validation = new Validator();

  $validation->validate($dataForm, [

    'name' => ['required' =>true],
    'population' => ['minNum' =>1],
    'id' => ['minNum' =>1]

  ]);


  if($validation->hasErrors()){

    $errors = '<ul class="list-unstyled text-start text-danger">';

    foreach($validation->getErrors() as $nameError){

        foreach($nameError as $valueError){
          $errors.="<li>$valueError</li>";
        }

    }

    $errors.='</ul>';

    $result = ['answer' =>'error', 'errors' =>$errors];

    
  }  else{

   
      edit_city($dataForm['name'], $dataForm['population'], $dataForm['id']);

      $result = ['answer' => 'success'];

  }

  echo json_encode($result);
  die;

}

if(isset($data['search'])){

  $wordS = trim($data['search']);

  $foundWord = findWord($wordS);

   require_once 'views/search.tpl.php';
  die;


}
