<?php

return [
    '/students' => 'StudentsController@index',
    '/students/create' => 'StudentsController@store',
    '/students/[0-9]+' => 'StudentsController@show',
    '/students/[0-9]+/update' => 'StudentsController@update',
    '/students/[0-9]+/delete' => 'StudentsController@destroy'
];