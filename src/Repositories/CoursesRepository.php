<?php

namespace App\Repositories;

use App\Database\EntityManagerFactory;
use App\Entity\Course;

class CoursesRepository
{
    private $entityManager;
    private $courseRepository;
    public function __construct()
    {
        $this->entityManager = EntityManagerFactory::createEntityManager();
        $this->courseRepository = $this->entityManager->getRepository(Course::class);
    }

    public function listAll()
    {
        return $this->courseRepository->findAll();
    }

    public function create($data)
    {
        $course = new Course($data['name']);
        $this->entityManager->persist($course);
        $this->entityManager->flush();
        return $course;
    }
}