<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Book;
use Faker\Factory;
class AppFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
        $namescate=['Programmation','Roman','Histoire','Chimie','Art','Langue'];
        $facker=Factory::create();
        for($i=0;$i<6;$i++)
        {
            $categ=new Category();
            $categ->setName($namescate[$i]);
            $manager->persist($categ);
              
                for($j=0;$j<10;$j++)
                {
                    $book=new Book();
                    $book->setTitle("Titre".$j);
                    $book->setPrice(100*$j);
                    $book->setAuthor($facker->address);
                    $book->setCategory($categ);
                    $manager->persist($book);
                }

        }
        $manager->flush();
    }
}