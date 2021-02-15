<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Products;
use App\Entity\Images;

class galleryController extends AbstractController
{
     /**
     * @Route("/admin/gallery/delete/{id}/{productid}", name="admin_gallery_delete")
     */
    public function delete(Images $img,$productid)
    {
        $fileSystem = new Filesystem();
            $fileSystem->remove($this->getParameter('gallery_directory')."/".$img->getPath());
        
            $em=$this->getDoctrine()->getManager();
            $em->remove($img);
            $em->flush();
            return $this->redirect('/admin/gallery/'.$productid);
      
    }
    /**
     * @Route("/admin/gallery/add/{id}", name="admin_gallery_add")
     * Method("GET","POST")
     */
    public function add($id,Request $request)
    {
        $img=new Images();
        $img->setProductid($id);
        $image=$request->files->get("image");
            $imagename = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->getParameter('gallery_directory'),$imagename);
            $img->setPath($imagename);
            $em=$this->getDoctrine()->getManager();
            $em->persist($img);
            $em->flush();
            return $this->redirect('/admin/gallery/'.$id);
        
    }
    /**
     * @Route("/admin/gallery/{id}", name="admin_gallery")
     */
    public function index($id)
    {
        $imgs=$this->getDoctrine()->getRepository(Images::class)->findby(["productid"=>$id]);
        return $this->render('admin/gallery/index.html.twig', [
            'productid' => $id,
            "imgs"=>$imgs
        ]);
    }
}
