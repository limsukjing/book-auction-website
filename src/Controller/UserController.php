<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 * @IsGranted("ROLE_ADMIN", message="Access Denied: Only users with ROLE_ADMIN are allowed to manage users.")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function indexAction(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // set role
            $role = $form->get('roles')->getData();
            $user->setRoles(array($role));

            // set and encode password
            $plainPassword = $form->get('password')->getData();
            $encodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);

            // add user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function showAction(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function editAction(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // update role
            $roles = $form->get('roles')->getData();
            $user->setRoles(array($roles));

            // update and encode password
            $plainPassword = $form->get('password')->getData();
            $encodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);

            // update user
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $currentUser = $this->getUser();
            $username = $user->getUsername();

            if($currentUser == $username) {
                $this->addFlash('error','Delete operation failed - user is currently logged in.');

                return $this->redirectToRoute('user_edit', [
                    'id' => $user->getId(),
                ]);
            }
            else {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($user);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('user_index');
    }
}
