<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Comment;
use App\Form\BookType;
use App\Form\CommentType;
use App\Repository\BookRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/", name="book_index", methods={"GET"})
     */
    public function indexAction(BookRepository $bookRepository): Response
    {
        // get currently logged in user
        $user = $this->getUser();

        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findAll(),
            'currentUsername' => $user
        ]);
    }

    /**
     * @Route("/new", name="book_new", methods={"GET","POST"})
     * @IsGranted("ROLE_SELLER", message="Access Denied: Only users with ROLE_SELLER are allowed to add book entries.")
     */
    public function newAction(Request $request): Response
    {
        $book = new Book();

        // set currently logged in user as the seller
        $seller = $this->getUser();
        $book->setSeller($seller);
        $book->setStatus('active');

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_show", methods={"GET","POST"})
     */
    public function showAction(Request $request, Book $book): Response
    {
        $comment = new Comment();

        // get currently logged in user
        $user = $this->getUser();
        $comment->setAuthor($user);
        $comment->setItem($book);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setAuthor($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Your comment has been submitted.');

            return $this->render('book/show.html.twig', [
                'book' => $book,
                'currentUsername' => $user,
                'comment' => $comment,
                'form' => $form->createView(),
            ]);
        }

        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Your comment has been deleted.');
        }

        return $this->render('book/show.html.twig', [
            'book' => $book,
            'currentUsername' => $user,
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_SELLER", message="Access Denied: Only users with ROLE_SELLER are allowed to edit book entries.")
     */
    public function editAction(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_show', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     * @IsGranted("ROLE_SELLER", message="Access Denied: Only users with ROLE_SELLER are allowed to delete book entries.")
     */
    public function deleteAction(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }
}
