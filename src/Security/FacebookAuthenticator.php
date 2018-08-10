<?php

namespace App\Security;

use Doctrine\ORM\EntityManager;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use League\OAuth2\Client\Provider\FacebookUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookAuthenticator extends SocialAuthenticator
{
    /**
     * @var ClientRegistry
     */
    private $clientRegistry;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * FacebookAuthenticator constructor.
     *
     * @param ClientRegistry  $clientRegistry
     * @param EntityManager   $em
     * @param RouterInterface $router
     */
    public function __construct(ClientRegistry $clientRegistry, EntityManager $em, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->em = $em;
        $this->router = $router;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request)
    {
        // continue ONLY if the current ROUTE matches the check ROUTE
        return 'connect_facebook_check' === $request->attributes->get('_route');
    }

    /**
     * @param Request $request
     *
     * @return \League\OAuth2\Client\Token\AccessToken|mixed
     */
    public function getCredentials(Request $request)
    {
        // this method is only called if supports() returns true

        // For Symfony lower than 3.4 the supports method need to be called manually here:
        // if (!$this->supports($request)) {
        //     return null;
        // }

        return $this->fetchAccessToken($this->getFacebookClient());
    }

    /**
     * @param mixed                 $credentials
     * @param UserProviderInterface $userProvider
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return null|object|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var FacebookUser $facebookUser */
        $facebookUser = $this->getFacebookClient()
            ->fetchUserFromToken($credentials);

        $email = $facebookUser->getEmail();

        // 1) have they logged in with Facebook before? Easy!
        $existingUser = $this->em->getRepository('AppBundle:User')
            ->findOneBy(['facebookId' => $facebookUser->getId()]);
        if ($existingUser) {
            return $existingUser;
        }

        // 2) do we have a matching user by email?
        $user = $this->em->getRepository('AppBundle:User')
            ->findOneBy(['email' => $email]);

        // 3) Maybe you just want to "register" them by creating
        // a User object
        $user->setFacebookId($facebookUser->getId());
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @return \KnpU\OAuth2ClientBundle\Client\OAuth2Client
     */
    private function getFacebookClient()
    {
        return $this->clientRegistry
            // "facebook_main" is the key used in config.yml
            ->getClient('facebook_main');
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // TODO: Implement start() method.
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // TODO: Implement onAuthenticationFailure() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }
}
