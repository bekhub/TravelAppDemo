<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AccountStatusException;

/**
 * Class SonataRegistrationController.
 *
 * This class is inspired from the FOS RegistrationController
 *
 *
 * @author Hugo Briand <briand@ekino.com>
 */
class RegistrationFOSUser1Controller extends Controller
{
    public function registerAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();


        if ($user instanceof UserInterface) {
            $this->container->get('session')->getFlashBag()->set('sonata_user_error', 'sonata_user_already_authenticated');
            $url = $this->container->get('router')->generate('sonata_user_profile_show');


            return new RedirectResponse($url);
        }

        $form = $this->container->get('sonata.user.registration.form');

        $formHandler = $this->container->get('sonata.user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);

        if ($process) {

            $user = $form->getData();
            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $url = $this->container->get('router')->generate('fos_user_registration_check_email');
//                $user->setEnabled(true);

                $RAW_QUERY = 'insert into '.$this->container->getParameter('database_name').'.fos_user_user_group (user_id, group_id) 
                     values ('.$user->getId().',1)';
                $em = $this->getDoctrine()->getManager();
                $statement = $em->getConnection()->prepare($RAW_QUERY);
                $statement->execute();
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

            } else {
                $authUser = true;
                $route = $this->container->get('session')->get('sonata_basket_delivery_redirect');

                if (null !== $route) {
                    $this->container->get('session')->remove('sonata_basket_delivery_redirect');
                    $url = $this->container->get('router')->generate($route);
                } else {
                    $url = $this->container->get('session')->get('sonata_user_redirect_url');
                }

            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $response = new RedirectResponse($url);

            if ($authUser) {

                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        if  ($form->isSubmitted()){
            $this->container->get('session')->getFlashBag()->set('error', 'Проверка логина на уникальность');
        }
        $this->container->get('session')->set('sonata_user_redirect_url', $this->container->get('request')->headers->get('referer'));

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Tell the user to check his email provider.
     */
    public function checkEmailAction()
    {
        $email = $this->container->get('session')->get('fos_user_send_confirmation_email/email');
        $this->container->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->container->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:checkEmail.html.'.$this->getEngine(), array(
            'user' => $user,
        ));
    }

    /**
     * Receive the confirmation token from user email provider, login the user.
     */
    public function confirmAction($token)
    {
        $user = $this->container->get('fos_user.user_manager')->findUserByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with confirmation token "%s" does not exist', $token));
        }


        $user->setConfirmationToken(null);
        $user->setEnabled(true);
        $user->setLastLogin(new \DateTime());

//        dump($this->container->getParameter('sonata.user.register.confirm.redirect_route'));
//        dump($this->container->get('router')->generate('fos_user_registration_confirmed'));
//        dump($this->container->getParameter('sonata.user.register.confirm.redirect_route_params'));
//        dump($user);
//        die();

        $this->container->get('fos_user.user_manager')->updateUser($user);


        if ($redirectRoute = $this->container->getParameter('sonata.user.register.confirm.redirect_route')) {
            $response = new RedirectResponse($this->container->get('router')->generate($redirectRoute, $this->container->getParameter('sonata.user.register.confirm.redirect_route_params')));
        } else {
            $response = new RedirectResponse($this->container->get('router')->generate('fos_user_registration_confirmed'));
        }


        $this->authenticateUser($user, $response);

        return $response;
    }

    /**
     * Tell the user his account is now confirmed.
     */
    public function confirmedAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:confirmed.html.'.$this->getEngine(), array(
            'user' => $user,
        ));
    }

    /**
     * Authenticate a user with Symfony Security.
     *
     * @param \FOS\UserBundle\Model\UserInterface        $user
     * @param \Symfony\Component\HttpFoundation\Response $response
     */
    protected function authenticateUser(UserInterface $user, Response $response)
    {
        try {
            $this->container->get('fos_user.security.login_manager')->loginUser(
                $this->container->getParameter('fos_user.firewall_name'),
                $user,
                $response);
        } catch (AccountStatusException $ex) {
            // We simply do not authenticate users which do not pass the user
            // checker (not enabled, expired, etc.).
        }
    }

    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }

    protected function getEngine()
    {
        return $this->container->getParameter('fos_user.template.engine');
    }
}
