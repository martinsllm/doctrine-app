<?php

return [
    'GET' => [
        '/students' => 'StudentsController@index',
        '/students/[0-9]+' => 'StudentsController@show',
        '/courses' => 'CoursesController@index',
    ],
    'POST' => [
        '/students' => 'StudentsController@store',
        '/courses' => 'CoursesController@store',
    ],
    'PUT' => [
        '/students/[0-9]+' => 'StudentsController@update',
    ],
    'DELETE' => [
        '/students/[0-9]+' => 'StudentsController@destroy'
    ],
];