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
        $studentRepository = $this->entityManager->getRepository(Student::class);
        return $studentRepository->findAll();
    }

    public function find($id)
    {
        $studentRepository = $this->entityManager->getRepository(Student::class);
        return $studentRepository->find($id);
    }

    public function create($data)
    {
        $student = new Student($data['name']);
        $this->entityManager->persist($student);
        $this->entityManager->flush();
        return $student;
    }

    public function update($id, $data)
    {
        $student = $this->find($id);
        $student->setName($data['name']);
        $this->entityManager->persist($student);
        $this->entityManager->flush();
        return $student;
    }

    public function delete($id)
    {
        $student = $this->find($id);
        $this->entityManager->remove($student);
        $this->entityManager->flush();
    }

}