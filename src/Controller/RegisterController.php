<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Comments;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
   /**
     * @Route("/register" , name="register")
     * Method("POST","GET")
     */
    public function register(Request $request){
        $msg="";
        $error="";
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('register', $submittedToken)) {
            $user=$this->getDoctrine()->getRepository(User::class)->findby(["email"=>$request->get("email")]);
            if($user==null){
                $user=new User();
                $user->setName($request->get("name"));
                $user->setEmail($request->get("email"));
                $user->setPassword($request->get("password"));
                $user->setAddress($request->get("address"));
                $user->setTel($request->get("tel"));
                $user->setRoles("ROLE_USER");
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $msg="your account has been created sucessfully";
            }
            else{
                $error="This email is already taken before !";
            }
        }
        return $this->render("User/main/register.html.twig",["msg"=>$msg,"error"=>$error]);
    }
 /**
     * @Route("/myaccount", name="account")
     * Method("POST","GET")
     */
    public function myaccount(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $msg="";
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('myaccount', $submittedToken)) {
            $user=$this->getDoctrine()->getRepository(User::class)->find($user->getId());
            $user->setName($request->get("name"));
            $user->setEmail($request->get("email"));
            $user->setAddress($request->get("address"));
            $user->setTel($request->get("tel"));
            if($request->get("newpass")!=""){
                $user->setPassword($request->get("newpass"));
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $msg="Updated Successfuly !!";
        }
        return $this->render("User/main/myaccount.html.twig",["msg"=>$msg]);
    }
}
