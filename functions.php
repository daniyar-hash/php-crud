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


