<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Controller;

use Application\Sonata\UserBundle\Entity\User;
use Application\Sonata\UserBundle\Form\Type\ProfileType;
use FOS\UserBundle\Model\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * This class is inspired from the FOS Profile Controller, except :
 *   - only twig is supported
 *   - separation of the user authentication form with the profile form.
 */
class ProfileFOSUser1Controller extends Controller
{
    /**
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function showAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

//        return $this->redirect($this->generateUrl('info_moderator_homepage'));
        return $this->render('SonataUserBundle:Profile:show.html.twig', array(
            'user'   => $user,
            'blocks' => $this->container->getParameter('sonata.user.configuration.profile_blocks'),
        ));
    }

    /**
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function editAuthenticationAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        die('keldi');
        $form = $this->container->get('sonata.user.authentication.form');
        $formHandler = $this->container->get('sonata.user.authentication.form_handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('sonata_user_success', 'profile.flash.updated');

            return new RedirectResponse($this->generateUrl('sonata_user_profile_show'));
        }

        return $this->render('SonataUserBundle:Profile:edit_authentication.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit-profile", name="profile_edit")
     * @throws AccessDeniedException
     */
    public function editProfileAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(new ProfileType(), $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'blog',
                'Ваш профиль успешно обновлен!'
            );

            return $this->redirect($this->generateUrl(
                'sonata_user_profile_show'
            ));
        }

        return $this->render('ApplicationSonataUserBundle:Profile:edit_profile.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }

    public function countCommentByUserAction()
    {
        $user = $this->getUser();
        if (!$user){
            return $this->redirectToRoute('fos_user_security_login');
        }
        $count = $this->getDoctrine()->getRepository('BlogBundle:Comment')
            ->findByUser($user);

        return $this->render('ApplicationSonataUserBundle:Profile:_count.html.twig', array(
            'count' => count($count)
        ));
    }
    public function countFavoritesByUserAction()
    {
        $user = $this->getUser();
        if (!$user){
            return $this->redirectToRoute('fos_user_security_login');
        }
        $count = $this->getDoctrine()->getRepository('BlogBundle:Favorites')
            ->findByUser($user);

        return $this->render('ApplicationSonataUserBundle:Profile:_count.html.twig', array(
            'count' => count($count)
        ));
    }

    /**
     * @Route("/all-users", name="all_users")
     */
    public function allUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('ApplicationSonataUserBundle:User')->findAll();

        return $this->render('ApplicationSonataUserBundle:Profile:users.html.twig', array(
            'users' => $users
        ));
    }
}
