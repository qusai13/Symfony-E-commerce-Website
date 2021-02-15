<?php

namespace App\Controller;
use App\Entity\Settings;
use App\Entity\Category;
use App\Entity\Products;
use App\Entity\Images;
use App\Entity\Comments;
use App\Entity\Slider;
use App\Entity\User;
use App\Entity\Cart;
use App\Entity\Orders;
use App\Entity\OrdersDetails;
use App\Entity\Messages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        $setting=$this->getDoctrine()->getRepository(Settings::class)->findAll();
        $setting=$setting[0];
        return $this->render('User/main/index.html.twig',["setting"=>$setting]);
    }
     /**
     * @Route("/product_detail/{id}", name="product_detail")
     */
    public function product_detail($id)
    {
        $product=$this->getDoctrine()->getRepository(Products::class)->find($id);
        $imgs=$this->getDoctrine()->getRepository(Images::class)->findby(["productid"=>$id]);
        $comments=$this->getDoctrine()->getRepository(Comments::class)->getwithuser($id);
        return $this->render('User/main/product_detail.html.twig',[
            "product"=>$product,
            "imgs"=>$imgs,
            "comments"=>$comments
        ]);
    }
    /**
     * @Route("/products/{id}", name="products")
     */
    public function products($id)
    {
        $category=$this->getDoctrine()->getRepository(Category::class)->find($id);
        $products=$this->getDoctrine()->getRepository(Products::class)->findby(["categoryid"=>$id]);
        return $this->render('User/main/products.html.twig',[
            "products"=>$products,
            "category"=>$category
        ]);
    }
   
    /**
     * @Route("/get_featured_products", name="get_featured_products")
     */
    public function get_featured_products()
    {
        $products=$this->getDoctrine()->getRepository(Products::class)->findRand(4);
       
        return $this->render('User/parts/featured_products.html.twig.',["products"=>$products]);
    }
    /**
     * @Route("/get_latest_products", name="get_latest_products")
     */
    public function get_latest_products()
    {
        $products=$this->getDoctrine()->getRepository(Products::class)->findLatest(4);
       
        return $this->render('User/parts/latest_products.html.twig.',["products"=>$products]);
    }
    /**
     * @Route("/get_slider", name="get_slider")
     */
    public function get_slider()
    {
        $sliders=$this->getDoctrine()->getRepository(Slider::class)->findAll();
       
        return $this->render('User/parts/slider.html.twig.',["sliders"=>$sliders]);
    }
    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function aboutus()
    {
        $setting=$this->getDoctrine()->getRepository(Settings::class)->findAll();
        $setting=$setting[0];
        return $this->render('User/main/aboutus.html.twig',["setting"=>$setting]);
    }
    /**
     * @Route("/contact", name="contact")
     * *Method("POST","GET")
     */
    public function contact(Request $request)
    {
        $setting=$this->getDoctrine()->getRepository(Settings::class)->findAll();
        $setting=$setting[0];
        $submittedToken = $request->request->get('token');
        $msg="";
        if ($this->isCsrfTokenValid('message', $submittedToken)) {
            $message=new Messages();
            $message->setName($request->get("name"));
            $message->setEmail($request->get("email"));
            $message->setSubject($request->get("subject"));
            $message->setMessage($request->get("message"));
            $message->setStatus("unread");
            $message->setMessagedate(date("Y-m-d h:i:sa"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();
            $msg="your message has been recieved sucessfully";
            
        }
        return $this->render('User/main/contact.html.twig',["setting"=>$setting,"msg"=>$msg]);
    }
    /**
     * @Route("/referans", name="referans")
     */
    public function referans()
    {
        $setting=$this->getDoctrine()->getRepository(Settings::class)->findAll();
        $setting=$setting[0];
        return $this->render('User/main/referans.html.twig',["setting"=>$setting]);
    }
     /**
     * @Route("/get_menu_cat", name="get_head")
     */
    public function get_menu_cat()
    {
        $cats=$this->cat_tree(0);
        return $this->render('menu_cat.html.twig',["cats"=>$cats]);
    }
    function cat_tree($id){
        $cats_string="";
        $cats=$this->getDoctrine()->getRepository(Category::class)->findby(["parentid"=>$id]);
        if($cats==null)
        return "";
        if($id!=0){
            $cats_string="<ul>";
        }
        
        foreach ($cats as $cat){
            $sub_cats=$this->cat_tree($cat->getId());
        $arrow="";
        if($sub_cats!="")
        $arrow="class='arrow'";
            $cats_string.="<li>";
            $cats_string.="<a ".$arrow."href='/products/".$cat->getId()."'>".$cat->getTitle()."</a>";
            $cats_string.=$sub_cats;
            $cats_string.="</li>";

        }
        if($id!=0)
           $cats_string.="</ul>";
           return $cats_string;
        

    }
      /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        
    }
    /**
     * @Route("/cart/add/{pid}/{q}", name="cart_to_add")
     */
    public function add_to_cart($pid,$q){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $cart=new Cart();
        $cart->setUserid($user->getId());
        $cart->setProductid($pid);
        $cart->setQuantity($q);
        $cart->setStatus("True");
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($cart);
        $entityManager->flush();
        return $this->redirect('/');

    }
    /**
     * @Route("/cartdetails/{id}",name="cartdetails")
     */
    public function cartdetails(Orders $order){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $order_details=$this->getDoctrine()->getRepository(OrdersDetails::class)->findwithproduct($order->getId());
        return $this->render("User/main/cartdetails.html.twig",["order"=>$order,"order_details"=>$order_details]);
    }
       /**
     * @Route("/mycarts", name="mycarts")
     */
    public function mycarts()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $order=$this->getDoctrine()->getRepository(Orders::class)->findby(["userid"=>$user->getId()]);
       
        return $this->render("User/main/mycart.html.twig",["orders"=>$order]);
    }
     /**
     * @Route("/cart", name="cart")
     */
    public function cart()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $carts=$this->getDoctrine()->getRepository(Cart::class)->findwithproduct($user->getId(),"True");
        return $this->render('User/main/cart.html.twig',["carts"=>$carts]);
    }
     /**
     * @Route("/cart/checkout", name="cart_checkout")
     */
    public function checkout(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $submittedToken = $request->request->get('token');
        $order=$this->getDoctrine()->getRepository(Orders::class)->findOneBy(["userid"=>$user->getId(),"status"=>"not_ready"]);
        if ($this->isCsrfTokenValid('check', $submittedToken)) {
           
            $order->setStatus("new");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirect('/mycarts');
        }

        
        return$this->render("User/main/checkout.html.twig",["order"=>$order]);
    }
         /**
     * @Route("/cart/address", name="cart_address")
     * Method("POST","GET")
     */
    public function cart_address(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $order=$this->getDoctrine()->getRepository(Orders::class)->findOneBy(["userid"=>$user->getId(),"status"=>"not_ready"]);
        if($request->get("paymenttype")!="")
        {
            $order->setPaymenttype($request->get("paymenttype"));
            $order->setShipname($request->get("shipname"));
            $order->setShipaddress($request->get("shipaddress"));
            $order->setShiptel($request->get("shiptel"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

        }
        
        return $this->render('User/main/cart_address.html.twig',["order"=>$order]);
    }
            /**
     * @Route("/cart/ready", name="cart_ready")
     * Method("POST","GET")
     */
    public function cart_ready()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $carts=$this->getDoctrine()->getRepository(Cart::class)->findwithproduct($user->getId());
        $order=new Orders();
        $order->setUserid($user->getId());
        $order->setCreateat(date("Y-m-d h:i:sa"));
        $order->setUpdateat(date("Y-m-d h:i:sa"));
        $order->setStatus("not_ready");
        $order->setPaymenttype("Cart");
        $order->setShipname($user->getName());
        $order->setShipaddress($user->getAddress());
        $order->setShiptel($user->getTel());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($order);
        $entityManager->flush();
        $total=0;
        foreach($carts as $cart){
            $total+=$cart["price"]*$cart["quantity"];
            $oreder_detail=new OrdersDetails();
            $oreder_detail->setOrderid($order->getId());
            $oreder_detail->setUserid($user->getId());
            $oreder_detail->setPid($cart["productid"]);
            $oreder_detail->setPrice($cart["price"]);
            $oreder_detail->setQuantity($cart["quantity"]);
            $oreder_detail->setAmount($cart["price"]*$cart["quantity"]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oreder_detail);
            $entityManager->flush();
            $c=$this->getDoctrine()->getRepository(Cart::class)->find($cart["id"]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($c);
            $entityManager->flush();


        }
        $order->SetAmount($total);
        $order->setTax("0");
        $order->setTotal($total);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirect('/cart/address');
    }
       /**
     * @Route("/cart/delete/{id}", name="cart_delete")
     */
    public function cart_delete(Cart $cart)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($cart);
        $em->flush();
        return $this->redirectToRoute("cart");
       
    }
    /**
     * @Route("comments" , name="comments")
     */
    public function comments(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $comments=$this->getDoctrine()->getRepository(Comments::class)->getwithproduct($user->getId());
        return $this->render("User/main/comments.html.twig",["comments"=>$comments]);
    }
    /**
     * @Route("comment/delete/{id}/{pid}",name="comment_delete")
    */
    public function comment_delete(Comments $comment,$pid){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($comment);
        $entityManager->flush();
        if($pid=="mycomments")
            return $this->redirect('/comments');
        return $this->redirect('/product_detail/'.$pid);
    }

    /** 
     * @Route("comment/add",name="comment_add")
     * Method("POST","GET")
     */
    public function comment_add(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('comment', $submittedToken)) {
            $comment=new Comments();
            $comment->setUserid($user->getId());
            $comment->setMsg($request->get("msg"));
            $comment->setProductid($request->get("pid"));
            $comment->setMsgdate(date("Y-m-d h:i:sa"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }
        return $this->redirect('/product_detail/'.$request->get("pid"));
    }
}
