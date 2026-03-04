<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Phone
{
    #[Id, GeneratedValue, Column]    
    public int $id;

    #[ManyToOne(targetEntity: Student::class, inversedBy: 'phones', cascade: ['persist'])]
    public readonly Student $student;

    public function __construct(
        #[Column(length: 13)]
        public readonly string $number
    ){}

    public function setStudent(Student $student){
        $this->student = $student;
    }
}