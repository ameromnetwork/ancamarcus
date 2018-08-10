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
     * @Route("/contact", name="contact_index")
     *
     * @param Request  $request
     * @param ApiLeads $apiLeads
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, ApiLeads $apiLeads)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();

            $requestData = \array_merge(
                $request->request->all(),
                $request->query->all()
            );

            $apiLeads->postContactRequest($contact, $requestData);

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

    /**
     * @Route("/email-subscribe", name="email_subscribe")
     *
     * @param Request  $request
     * @param ApiLeads $apiLeads
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function emailSubscribe(Request $request, ApiLeads $apiLeads)
    {
        $email = $request->get('subscribe_email', false);
        $routeRedirect = $request->get('route_redirect', false);

        $requestData = \array_merge(
            $request->request->all(),
            $request->query->all()
        );

        if (false !== $email) {
            $apiLeads->postEmailSubscriptionRequest($email, $requestData);
        }

        $this->addFlash(
            'notice',
            'You have been subscribed!'
        );

        if (false !== $routeRedirect) {
            return $this->redirectToRoute($routeRedirect);
        }

        return $this->redirectToRoute('home_index');
    }
}
