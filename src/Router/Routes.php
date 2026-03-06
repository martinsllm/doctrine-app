<?php

return [
    'GET' => [
        '/students' => 'StudentsController@index',
        '/students/[0-9]+' => 'StudentsController@show',
    ],
    'POST' => [
        '/students' => 'StudentsController@store',
    ],
    'PUT' => [
        '/students/[0-9]+' => 'StudentsController@update',
    ],
    'DELETE' => [
        '/students/[0-9]+' => 'StudentsController@destroy'
    ],
];