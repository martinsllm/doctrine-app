<?php

namesPace App\Repositories;

use App\Database\EntityManagerFactory;
use App\Entity\Student;

class StudentRepository
{
    private $entityManager;
    public function __construct()
    {
        $this->entityManager = EntityManagerFactory::createEntityManager();
    }

    public function listAll()
    {
        $studentRepository = $this->entityManager->getRepository('App\Entity\Student');
        return $studentRepository->findAll();
    }

    public function create($data)
    {
        $student = new Student($data['name']);
        $this->entityManager->persist($student);
        $this->entityManager->flush();
        return $student;
    }

}