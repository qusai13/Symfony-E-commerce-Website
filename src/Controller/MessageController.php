<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Messages;

class MessageController extends AbstractController
{
  /**
     * @Route("/admin/messages/{type}", name="messages")
     */
    public function index($type)
    {
        $messages=$this->getDoctrine()->getRepository(Messages::class)->findby(["status"=>$type]);
        return $this->render('message/message.html.twig', [
            'messages' =>$messages,
            'type'=>$type
        ]);
    }
    /**
     * @Route("/admin/messages_type/{id}/{type}", name="messages_set_type")
     */
    public function set_type(Messages $message,$type)
    {
        $message->setStatus($type);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirect("/admin/messages/".$type);
    }
    /**
     * @Route("/admin/messages/delete/{id}", name="message_delete")
     */
    public function delete(Messages $message)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($message);
        $entityManager->flush();
        return $this->redirect('/admin/messages/unread');
    }
}
