<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
         * @Route("/inscription", name="api_security_registration",methods={"POST"})
         */
    public function registration()
    {
        $user= new User();
        var_dump($user);

        return $user;
    }
}