<?php





function print_arr($data)
{
    echo '<pre>'. print_r($data, 1). '</pre>';
}

function get_count_t($table)
{
    global $db;
    return $db->query("SELECT COUNT(*) FROM $table")->findColumn();
}

function get_cities($start, $per_page)
{
    global $db;

    return $db->query("SELECT * FROM city LIMIT $start, $per_page")->findAll();
}


function add_city($city, $population)
{
    global $db;

    return $db->query("INSERT INTO city (`name`, `population`) VALUES (?, ?)", [$city, $population]);
}


function edit_city($city, $population, $id)
{
    global $db;

    return $db->query("UPDATE city SET `name` = ? , `population` = ? WHERE id = ?", [$city, $population, $id]);
     
   
}

function findWord($word){
    global $db;
    return $db->query("SELECT * FROM city WHERE name LIKE ?", ["%{$word}%"])->findAll();
}


