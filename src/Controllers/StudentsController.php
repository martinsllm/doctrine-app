<?php

namespace App\Controllers;

use App\Repositories\StudentRepository;

class StudentsController
{
    private $studentRepository;
    public function __construct()
    {
        $this->studentRepository = new StudentRepository();
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
        echo json_encode($student->toArray());
    }

    public function update($params)
    {
        // Lê o corpo da requisição crua
        $jsonData = file_get_contents('php://input');

        // Decodifica a string JSON em um array associativo PHP
        $data = json_decode($jsonData, true);

        $student = $this->studentRepository->update($params['students'], $data);
        echo json_encode($student->toArray());
    }

    public function destroy($params)
    {
        $this->studentRepository->delete($params['students']);
        echo json_encode(['success' => true]);
    }

}