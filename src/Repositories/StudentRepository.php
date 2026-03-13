<?php

namesPace App\Repositories;

use App\Database\EntityManagerFactory;
use App\Entity\Course;
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
        $dql = "SELECT s, p, c FROM App\Entity\Student s LEFT JOIN s.phones p LEFT JOIN s.courses c WHERE s.id = :id";
        return $this->entityManager->createQuery($dql)->setParameter('id', $id)->getResult();
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

    public function enrollInCourse($data)
    {
        $student = $this->find($data['student_id']);
        $course = $this->entityManager->getRepository(Course::class)->find($data['course_id']);
        $student->enrollInCourse($course);
        
        $this->entityManager->flush();
    }

}