<?php

namespace App\Controller\Admin;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class categoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function index()
    {
        $categories=$this->getDoctrine()->getRepository(Category::class)->findwithparent();
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
      /**
     * @Route("/admin/category/add", name="admin_category_add",methods="GET|POST")
     */
    public function Add(Request $request)
    {
        
        
        if($request->get('title')!=null){
            $category=new Category();
            $category->setTitle($request->get("title"));
            $category->setDescription($request->get("description"));
            $category->setParentid($request->get("parentid"));
            $category->setKeywords($request->get("keywords"));
            $category->setStatus($request->get("statu"));
            $category->setCreatedat(date("Y-m-d H:i:s"));
            $category->setUpdatedat(date("Y-m-d H:i:s"));
            $em=$this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('admin_category');
        }
        $cats=$this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/category/add.html.twig',[
            "cats"=>$cats
        ]);
    }
     /**
     * @Route("/admin/category/edit/{id}", name="admin_category_edit",methods="GET|POST")
     */
    public function Edit(Request $request,Category $category)
    {
        
        
        if($request->get('title')!=null){
            
            $category->setTitle($request->get("title"));
            $category->setDescription($request->get("description"));
            $category->setParentid($request->get("parentid"));
            $category->setKeywords($request->get("keywords"));
            $category->setStatus($request->get("statu"));
            $category->setUpdatedat(date("Y-m-d H:i:s"));
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_category');
        }
        $cats=$this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('admin/category/edit.html.twig',[
            "category"=>$category,
            "cats"=>$cats
        ]);
    }
     /**
     * @Route("/admin/category/delete/{id}", name="admin_category_delete")
     */
    public function delete(Category $category)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute("admin_category");
    }
    
}
