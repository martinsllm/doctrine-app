<?php

namespace App\Controllers;

use App\Entity\Course;
use App\Entity\Phone;
use App\Repositories\CoursesRepository;
use App\Repositories\StudentRepository;

class StudentsController
{
    private $studentRepository;
    private $courseRepository;
    public function __construct()
    {
        $this->studentRepository = new StudentRepository();
        $this->courseRepository = new CoursesRepository();
    }
    
    public function index()
    {
        $students = $this->studentRepository->listAll();
        $data = array_map(function ($student) {
            return $student->toArray();
        }, $students);

        echo json_encode($data);
    }

    public function store(){
        // Lê o corpo da requisição crua
        $jsonData = file_get_contents('php://input');

        // Decodifica a string JSON em um array associativo PHP
        $data = json_decode($jsonData, true);

        $student = $this->studentRepository->create($data);

        echo json_encode($student->toArray());
    }

    public function show($params)
    {
        $student = $this->studentRepository->find($params['students']);
        $phones = array_map(function ($phone) {
            return $phone->toArray();
        }, $student[0]->getPhones()->toArray());
        $courses = array_map(function ($course) {
            return $course->toArray();
        }, $student[0]->getCourses()->toArray());
        
        echo json_encode([
            'student' => $student[0]->toArray(),
            'phones' => $phones,
            'courses' => $courses
        ]);
    }

    public function update($params)
    {
        $jsonData = file_get_contents('php://input');

        $data = json_decode($jsonData, true);

        $student = $this->studentRepository->update($params['students'], $data);
        echo json_encode($student->toArray());
    }

    public function destroy($params)
    {
        $this->studentRepository->delete($params['students']);
        echo json_encode(['success' => true]);
    }

    public function enrollInCourse()
    {
        $jsonData = file_get_contents('php://input');

        $data = json_decode($jsonData, true);

        $this->studentRepository->enrollInCourse($data);

        echo json_encode(['success' => true]);
    }

}