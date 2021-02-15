<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\Products;
use App\Entity\Category;
class productController extends AbstractController
{
    /**
     * @Route("/admin/product", name="admin_product")
     */
    public function index()
    {
        $products=$this->getDoctrine()->getRepository(Products::class)->findwithcategory();
        return $this->render('admin/product/index.html.twig', [
            'products' => $products,
        ]);
    }
     /**
     * @Route("/admin/product/add", name="admin_product_add",methods="GET|POST")
     */
    public function Add(Request $request)
    {
        
        
        if($request->get('title')!=null){
            $product=new Products();
            $product->setTitle($request->get("title"));
            $product->setDescription($request->get("description"));
            $product->setType($request->get("type"));
            $product->setPublisherid($request->get("publisherid"));
            $product->setAmount($request->get("amount"));
            $product->setPprice($request->get("pprice"));
            $product->setSprice($request->get("sprice"));
            $product->setDetail($request->get("detail"));
            $product->setUserid($request->get("userid"));
            $product->setCategoryid($request->get("categoryid"));
            $product->setKeywords($request->get("keywords"));
            $product->setStatus($request->get("statu"));
            $product->setCreatedat(new \DateTime('today'));
            $product->setUpdatedat(date("Y-m-d H:i:s"));
            $image=$request->files->get("image");
            $imagename = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('product_imgs_directory'),$imagename);
            $product->setImage($imagename);
            $em=$this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('admin_product');
        }
        $cats=$this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/product/add.html.twig',[
            "cats"=>$cats
        ]);
    }
    /**
     * @Route("/admin/product/edit/{id}", name="admin_product_edit",methods="GET|POST")
     */
    public function Edit(Request $request,Products $product)
    {
        
        
        if($request->get('title')!=null){
            $product->setTitle($request->get("title"));
            $product->setDescription($request->get("description"));
            $product->setType($request->get("type"));
            $product->setPublisherid($request->get("publisherid"));
            $product->setAmount($request->get("amount"));
            $product->setPprice($request->get("pprice"));
            $product->setSprice($request->get("sprice"));
            $product->setDetail($request->get("detail"));
            $product->setUserid($request->get("userid"));
            $product->setCategoryid($request->get("categoryid"));
            $product->setKeywords($request->get("keywords"));
            $product->setStatus($request->get("statu"));
            $product->setUpdatedat(date("Y-m-d H:i:s"));
            $image=$request->files->get("image");
            if($image!=null){
            $fileSystem = new Filesystem();
            $fileSystem->remove($this->getParameter('product_imgs_directory')."/".$product->getImage());
            $imagename = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('product_imgs_directory'),$imagename);
            $product->setImage($imagename); 
            }
         
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_product');
        }
        $cats=$this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/product/edit.html.twig',[
            "product"=>$product,
            "cats"=>$cats
        ]);
    }
    /**
     * @Route("/admin/product/delete/{id}", name="admin_product_delete")
     */
    public function delete(Products $product)
    {
        $fileSystem = new Filesystem();
        $fileSystem->remove($this->getParameter('product_imgs_directory')."/".$product->getImage());
        $em=$this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute("admin_product");
    }
  
}
