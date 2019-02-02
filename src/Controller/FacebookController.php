<?php

namespace App\Controller;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FacebookController.
 */
class FacebookController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process.
     *
     * @Route("/connect/facebook")
     */
    public function connectAction(Request $request, \KnpU\OAuth2ClientBundle\Client\ClientRegistry $clientRegistry)
    {
        // will redirect to Facebook!
        return $clientRegistry
            ->getClient('facebook_main') // key used in config.yml
            ->redirect();
    }

    /**
     * After going to Facebook, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config.yml.
     *
     * @Route("/connect/facebook/check", name="connect_facebook_check")
     *
     * @param Request $request
     */
    public function connectCheckAction(Request $request, \KnpU\OAuth2ClientBundle\Client\ClientRegistry $clientRegistry)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
        // (read below)

        /** @var \KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient $client */
        $client = $clientRegistry->getClient('facebook_main');

        try {
            // the exact class depends on which provider you're using
            /** @var \League\OAuth2\Client\Provider\FacebookUser $user */
            $user = $client->fetchUser();

            // do something with all this new power!
            $user->getFirstName();
            // ...
        } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            \var_dump($e->getMessage());
            die;
        }
    }
}
