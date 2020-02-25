<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleFormType;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractController
{
    /**
    * @Route("/newM", name="module")
    */
    public function new(Request $request):Response
   {
       $module= new Module();
       $form = $this->createForm(ModuleFormType::class, $module);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($module);
            $entityManager->flush();
           $this->addFlash('succes','Module Ajouté');
           return $this->redirectToRoute("home");
       }
       return $this->render("module.html.twig",[
           'moduleForm'=> $form -> createView()

       ]);
   } 

   /**
    * @Route("/modules", name="afficheModule")
    */
   public function index()
   {
        $repository = $this->getDoctrine()->getRepository(Module::class);
        $module = $repository->findAll();
        return $this->render('module/index.html.twig',[
            "modules" =>$module
        ]);

   }
}