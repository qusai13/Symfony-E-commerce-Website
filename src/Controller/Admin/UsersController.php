<?php

namespace App\Controller\Admin;
use App\Entity\User;
use App\Form\UsersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class UsersController extends AbstractController
{
    /**
     * @Route("/admin/users/add", name="admin_users",methods="GET|POST")
     */
    public function Add(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UsersType::class,$user);
        $form->handlerequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($request->get("password"));
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin_main');
        }
        return $this->render('admin/users/add.html.twig',[
            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route("/admin/users/edit/{id}", name="admin_users_edit",methods="GET|POST")
     */
    public function edit(Request $request,User $user)
    {
        $em=$this->getDoctrine()->getManager();
        if(trim($request->get("password"))!=""){
            $user->setPassword($request->get("password"));
        }
        $form = $this->createForm(UsersType::class,$user);
        $form->handlerequest($request);
        $em->flush();
        return $this->redirectToRoute('admin_main');
    }
      /**
     * @Route("/admin/users/delete/{id}", name="admin_users_delete",methods="GET|POST")
     */
    public function delete(Request $request,User $user)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('admin_main');
    }
}
