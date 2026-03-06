<?php

return [
    'GET' => [
        '/students' => 'StudentsController@index',
        '/students/[0-9]+' => 'StudentsController@show',
        '/courses' => 'CoursesController@index',
        '/courses/[0-9]+' => 'CoursesController@show',
    ],
    'POST' => [
        '/students' => 'StudentsController@store',
        '/courses' => 'CoursesController@store',
        '/students/courses' => 'StudentsController@enrollInCourse',
    ],
    'PUT' => [
        '/students/[0-9]+' => 'StudentsController@update',
    ],
    'DELETE' => [
        '/students/[0-9]+' => 'StudentsController@destroy'
    ],
];