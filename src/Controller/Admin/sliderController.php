<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Slider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;

class sliderController extends AbstractController
{
    /**
     * @Route("/admin/slider", name="admin_slider")
     */
    public function index()
    {
        $sliders=$this->getDoctrine()->getRepository(Slider::class)->findAll();
        return $this->render('admin/slider/index.html.twig', [
            "slider"=>$sliders,
        ]);
    }
     /**
     * @Route("/admin/slider/add", name="admin_slider_add")
     */
    public function add(Request $request)
    {
        $slider=new Slider();
        $image=$request->files->get("image");
        if ($image!=null){
            $imagename = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('slider_imgs_directory'),$imagename);
            $slider->setImage($imagename);
            $slider->setURL($request->get("url"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($slider);
            $entityManager->flush();
            return $this->redirect('/admin/slider');
        }
        return $this->render('admin/slider/add.html.twig');
        
    }
  /**
     * @Route("/admin/slider/edit/{id}", name="slider_edit")
     * Method('GET','POST')
     */
    public function edit(Request $request,Slider $slider)
    {
        $image=$request->files->get("image");
        if ($image!=null){
            $fileSystem = new Filesystem();
            $fileSystem->remove($this->getParameter('slider_imgs_directory')."/".$slider->getImage());
            $imagename = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('slider_imgs_directory'),$imagename);
            $slider->setImage($imagename);
            $slider->setUrl($request->get("url"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirect('/admin/slider');
        }
        if($request->get("url")!=null){
            $slider->setUrl($request->get("url"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirect('/admin/slider');
        }
        return $this->render('admin/slider/edit.html.twig',["slider"=>$slider]);
    }
      /**
     * @Route("/admin/slider/delete/{id}", name="slider_delete")
     * Method('GET','POST')
     */
    public function delete(Slider $slider)
    {
        $fileSystem = new Filesystem();
        $fileSystem->remove($this->getParameter('slider_imgs_directory')."/".$slider->getImage());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($slider);
        $entityManager->flush();
        return $this->redirect('/admin/slider');
    }
}
       

