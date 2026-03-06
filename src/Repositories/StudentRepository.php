<?php

namesPace App\Repositories;

use App\Database\EntityManagerFactory;
use App\Entity\Phone;
use App\Entity\Student;

class StudentRepository
{
    private $entityManager;
    private $studentRepository;
    public function __construct()
    {
        $this->entityManager = EntityManagerFactory::createEntityManager();
        $this->studentRepository = $this->entityManager->getRepository(Student::class);
    }

    public function listAll()
    {
        return $this->studentRepository->findAll();
    }

    public function find($id)
    {
        return $this->studentRepository->find($id);
    }

    public function create($data)
    {
        $student = new Student($data['name']);

        if($data['phone']){
            array_map(function ($phone) use ($student) {
                $student->addPhone(new Phone($phone));
            }, $data['phone']);
        }
        
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