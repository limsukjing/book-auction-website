<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/auction")
 * @IsGranted("ROLE_SELLER", message="Access Denied: Only users with ROLE_SELLER are alllowed to monitor auctions.")
 */
class AuctionController extends AbstractController
{
    /**
     * @Route("/", name="auction_index", methods={"GET"})
     */
    public function indexAction(BookRepository $bookRepository): Response
    {
        $user = $this->getUser(); // get currently logged in user
        $offers = $bookRepository->findOffers();

        // store highest bidder in session
        $session = new Session();
        $session->set('offers', $offers);

        return $this->render('auction/index.html.twig', [
            'books' => $bookRepository->findAll(),
            'currentUsername' => $user,
        ]);
    }

    /**
     * @Route("/success", name="auction_success", methods={"GET"})
     */
    public function successAction(BookRepository $bookRepository): Response
    {
        $user = $this->getUser(); // get currently logged in user

        return $this->render('auction/success.html.twig', [
            'books' => $bookRepository->findAll(),
            'currentUsername' => $user,
        ]);
    }

    /**
     * @Route("/book/{id}", name="auction_show", methods={"GET"})
     */
    public function showAction(BookRepository $bookRepository, Book $book): Response
    {
        $user = $this->getUser(); // get currently logged in user
        $currentBook = $book->getTitle(); // get title of book

        return $this->render('auction/show.html.twig', [
            'books' => $bookRepository->findAll(),
            'book' => $book,
            'currentUsername' => $user,
            'currentBook' => $currentBook,
        ]);
    }
}
