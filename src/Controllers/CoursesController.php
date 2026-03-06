<?php

namespace App\Controllers;

use App\Entity\Student;
use App\Repositories\CoursesRepository;

class CoursesController 
{
    private $courseRepository;
    public function __construct() 
    {
        $this->courseRepository = new CoursesRepository();
    }

    public function index()
    {
        $courses = $this->courseRepository->listAll();
        $data = array_map(function ($course) {
            return $course->toArray();
        }, $courses);

        echo json_encode($data);
    }

    public function show($params)
    {
        $course = $this->courseRepository->find($params['courses']);
        
        $students = array_map(function ($student) {
            return $student->toArray();
        }, $course->getStudents()->toArray());

        echo json_encode([
            'course' => $course->toArray(),
            'students' => $students
        ]);
    }

    public function store()
    {
        // Lê o corpo da requisição crua
        $jsonData = file_get_contents('php://input');

        // Decodifica a string JSON em um array associativo PHP
        $data = json_decode($jsonData, true);

        $course = $this->courseRepository->create($data);

        echo json_encode($course->toArray());
    }
}