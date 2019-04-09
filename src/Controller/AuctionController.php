<?php

namespace App\Controller;

use App\Repository\BidRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auction")
 * @IsGranted("ROLE_SELLER", message="Access Denied: Only users with ROLE_SELLER are alllowed to monitor auctions.")
 */
class AuctionController extends AbstractController
{
//    /**
//     * @Route("/book/{id}/details", name="bid_index", methods={"GET"})
//     */
//    public function indexAction(BidRepository $bidRepository, Book $book): Response
//    {
//        // get viewed book
//        $title = $book->getTitle();
//
//        return $this->render('auction/index.html.twig', [
//            'bids' => $bidRepository->findAll(),
//            'bookTitle' => $title
//        ]);
//    }

}
