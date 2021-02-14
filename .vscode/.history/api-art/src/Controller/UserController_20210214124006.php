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
     * @Route("/user", name="user",methods={"GET"})
     */
  
       
        public function index(UserRepository $userRepository,Request $request)
        {
            $user = $userRepository->findAll();
            $jsonRecu = $request->getContent();
            
            $response = $this->json($user,200,[],['groups'=>'user:read']);
           
           
            
    
            return $response;
        }
    
        /**
         * @Route("api/user", name="api_user_create",methods={"POST"})
         */
        public function create(Request $request,UserPasswordEncoderInterface $encoder,SerializerInterface $serializer,EntityManagerInterface $em,
        ValidatorInterface $validator){
          
           try{
            $jsonRecu = $request->getContent();
            $user = $serializer->deserialize($jsonRecu,User::class,'json');
            $user = new User();
            $plainPassword = 'ryanpass';
            $encoded = $encoder->encodePassword($user, $plainPassword);

    $user->setPassword($encoded);
            $errors = $validator->validate( $user);
            if(count($errors) > 0){
                return $this->json($errors,400);
            }
            $em->persist($user);
            $em->flush();
    
           return $this->json($user, 201,[],['groups'=>'user:read']);
           }catch(NotEncodableValueException $e){
               return $this->json([
                   'status'=>400,
                   'message'=>$e->getMessage()
               ],400);
           }
        
        }
        
    
        
}

