<?php

namespace App\Controller;

use App\Entity\Devis;
use App\Repository\DevisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ContactController extends AbstractController
{
   
    /**
     * @Route("api/devis", name="api_devis_index",methods={"GET"})
     */
    public function index(DevisRepository $devisRepository,Request $request)
    {
        $devis = $devisRepository->findAll();
        $jsonRecu = $request->getContent();
        

        $response = $this->json($devis,200,[],['groups'=>'devis:read']);

        return $response;
    }

    /**
     * @Route("api/devis", name="api_devis_create",methods={"POST"})
     */
    public function create(Request $request,SerializerInterface $serializer,EntityManagerInterface $em,
    ValidatorInterface $validator){
      
       try{
        $jsonRecu = $request->getContent();
        $contact = $serializer->deserialize($jsonRecu,Contact::class,'json');
        // $contact->setDate(new\DateTime());
        $errors = $validator->validate( $contact);
        if(count($errors) > 0){
            return $this->json($errors,400);
        }
        $em->persist($contact);
        $em->flush();

       return $this->json($contact, 201,[],['groups'=>'devis:read']);
       }catch(NotEncodableValueException $e){
           return $this->json([
               'status'=>400,
               'message'=>$e->getMessage()
           ],400);
       }
    
    }
    

    
}
