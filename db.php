<?php

return [

"db" => [

    "hostname" => "localhost",
    "dbname" =>"world2",
    "username" =>"root",
    "password" =>"",
     "charset" => "utf8",
     "options" =>[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

     ],
],

     "per_page" => 10,
];





