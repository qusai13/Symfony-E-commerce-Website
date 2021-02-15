<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends AbstractController
{
    /**
     * @Route("/admin/settings", name="settings")
     */
    public function index()
    {
        $setting=$this->getDoctrine()->getRepository(Settings::class)->findAll();
        $setting=$setting[0];
        return $this->render('admin/settings/index.html.twig', [
            'setting' => $setting,
        ]);
    }
    /**
     * @Route("/admin/settings/update", name="settings_update")
     * Method("POST","GET")
     */
    public function update(Request $request){
        $setting=$this->getDoctrine()->getRepository(Settings::class)->findAll();
        $setting=$setting[0];
        $setting->setTitle($request->get("title"));
        $setting->setDescription($request->get("description"));
        $setting->setKeywords($request->get("keywords"));
        $setting->setCompany($request->get("company"));
        $setting->setAddress($request->get("address"));
        $setting->setEmail($request->get("email"));
        $setting->setFax($request->get("fax"));
        $setting->setTel($request->get("tel"));
        $setting->setSmtpserver($request->get("smtpserver"));
        $setting->setSmtpmail($request->get("smtpmail"));
        $setting->setSmtppasw($request->get("smtppasw"));
        $setting->setSmtpport($request->get("smtpport"));
        $setting->setContact($request->get("contact"));
        $setting->setAboutus($request->get("aboutus"));
        $setting->setReferans($request->get("referans"));
        $setting->setUpdatedat(date("Y-m-d h:i:sa"));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($setting);
        $entityManager->flush();
        return $this->redirect('/admin/settings');
    }
}
