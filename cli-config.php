<?php

require 'vendor/autoload.php';

use App\Database\EntityManagerFactory;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

$config = new PhpFile(__DIR__ . '/migrations.php'); 

$entityManager = EntityManagerFactory::createEntityManager();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));