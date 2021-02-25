<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users",methods={"GET"})
     */
  
       
        public function index(UserRepository $userRepository,Request $request)
        {
            
            $user = $userRepository->findAll();
            // $jsonRecu = $request->getContent();
            
            $response = $this->json($user,200,[],['groups'=>'user:read']);
            return $response;
        }
       
    
        /**
         * @Route("api/users/create", name="api_user_create",methods={"POST"})
         */
        public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        // $password = $request->get('password');
        // $email = $request->get('email');
        $user = new User();
        $hash = $encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);
        // $email= $user->getEmail();
        // $user->setEmail($email);
        // $firstName=$user->getFirstname();
        // $user->setFirstname($firstName);
        // $lastName=$user->getLastname();
        // $user->setLastname($lastName);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->json($user, 201,[],['groups'=>'user:read']);
        // return $this->json([
        //      $user
        // ]);
    }
    /**
         * @Route("api/users/login", name="api_user_login",methods={"POST"})
         */
    public function login()
    {
        return $this->json([
            'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
        
    
        
}

