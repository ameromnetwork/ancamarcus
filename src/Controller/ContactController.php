<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 8/1/2018
 * Time: 4:02 AM.
 */

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Service\ApiLeads;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @return mixed
     *
     * @Route("/contact", name="contact_index")
     */
    public function index(Request $request, ApiLeads $apiLeads)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();

            $apiLeads->ApiPostAction($contact, $request);

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );

            return $this->render('Contact/index.html.twig', array(
                'form' => $form->createView(),
            ));
        }



        return $this->render('Contact/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
