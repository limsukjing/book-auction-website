<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/{id}", name="comment_delete", methods={"DELETE"})
     * @IsGranted("IS_AUTHENTICATED_FULLY", message="Access Denied: Only authorized users are allowed to manage comment entries.")
     */
    public function delete(Request $request, Comment $comment): Response
    {
        // get currently logged in user
        $user = $this->getUser();
        $book = $comment->getItem();

        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Your comment has been deleted.');

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        return $this->render('book/show.html.twig', [
            'book' => $book,
            'currentUsername' => $user,
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }
}
