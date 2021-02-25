<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
    * @Route("api/user", name="api_user_create",methods={"POST"})
    */
    public function registration(Request $request,SerializerInterface $serializer,EntityManagerInterface $em,UserPasswordEncoderInterface $encoder)
    {
        $jsonRecu = $request->getContent();
        $user = $serializer->deserialize($jsonRecu,User::class,'json');
       
       $hash = $encoder->encodePassword($user, $user->getPassword());
       $user->setPassword($hash);
       $user->setRoles(['ROLE_USER']);
    
       $em->persist($user);
       $em->flush();

      return $this->json($user, 201,[]);

        
    }
}