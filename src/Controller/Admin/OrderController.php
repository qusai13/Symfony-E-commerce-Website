<?php

namespace App\Controller\Admin;
use App\Entity\User;

use App\Entity\Orders;
use App\Entity\OrdersDetails;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/admin/order/edit/{id}/{type}", name="admin_order_edit")
     * Method("GET","POST")
     */
    public function admin_order_edit(Orders $order,Request $request,$type)
    {
        $order_details=$this->getDoctrine()->getRepository(OrdersDetails::class)->findwithproduct($order->getId());
        $orders=$this->getDoctrine()->getRepository(Orders::class)->findby(["status"=>$type]);
        if($request->get("status")!=""){
            $order->setStatus($request->get("status"));
            $order->setShipinf($request->get("shipinf"));
            $order->setShipcompany($request->get("shipcompany"));
            $order->setNote($request->get("note"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
        }
        return $this->render('/order/edit.html.twig', [
            'order' => $order,
            'order_details'=>$order_details,
            'type'=>$type
        ]);
    }

  /**
     * @Route("/admin/order/{type}", name="admin_order")
     */
    public function index($type)
    {
        $orders=$this->getDoctrine()->getRepository(Orders::class)->findby(["status"=>$type]);
        return $this->render('/order/index.html.twig', [
            'orders' => $orders,
            'type'=>$type
        ]);
    }
    
}
