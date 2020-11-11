<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 5; $i++) {
            $contact = new Contact();
            $contact->setName('contact '.$i);
            $contact->setMail('mail '.$i);
            $contact->setSubject('subject '.$i);
            $contact->setMessage('message '.$i);
            $manager->persist($contact);
        }

        $manager->flush();
    }
}