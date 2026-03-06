<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Student
{
    #[Id, Column, GeneratedValue]
    private int $id;

    #[Column]
    private string $name;

    #[OneToMany(Phone::class, mappedBy: 'student', cascade: ['persist', 'remove'])]
    private Collection $phones;

    #[ManyToMany(Course::class, inversedBy: 'students')]
    private Collection $courses;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toArray(){
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function addPhone(Phone $phone){
        $this->phones->add($phone);
        $phone->setStudent($this);
    }

    public function getPhones(): Collection {
        return $this->phones;
    }

    public function getCourses(): Collection {
        return $this->courses;
    }

    public function enrollInCourse(Course $course)
    {
        if($this->courses->contains($course)){
            return;
        }
        
        $this->courses->add($course);
        $course->addStudent($this);
    }
}