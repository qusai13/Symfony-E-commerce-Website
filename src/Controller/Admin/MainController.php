<?php

namespace App\Controller\Admin;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->redirectToRoute('admin_main');
    }
    /**
     * @Route("/admin/users", name="admin_main")
     */
    public function users()
    {
        $users=$this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/users/index.html.twig',['users' => $users,]);
    }
     /**
     * @Route("/admin/tables", name="tables")
     */
    public function tables()
    {
        return $this->render('admin/pages/tables.html.twig');
    }
  
        /**
     * @Route("/admin/notifications", name="notifications")
     */
    public function notificatios()
    {
        return $this->render('admin/pages/notifications.html.twig');
    }
    
    
}
