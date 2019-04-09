<?php

namespace App\Controller;

use App\Entity\Bid;
use App\Entity\Book;
use App\Form\BidType;
use App\Repository\BidRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bid")
 * @IsGranted("ROLE_BUYER", message="Access Denied: Only users with ROLE_BUYER are alllowed to participate in bidding.")
 */
class BidController extends AbstractController
{
    /**
     * @Route("/", name="bid_index", methods={"GET"})
     */
    public function manageBidAction(BidRepository $bidRepository): Response
    {
        // get currently logged in user
        $user = $this->getUser();

        return $this->render('bid/index.html.twig', [
            'bids' => $bidRepository->findAll(),
            'currentUsername' => $user,
        ]);
    }

    /**
     * @Route("/book/{id}", name="bid_new", methods={"GET","POST"})
     */
    public function bidAction(BidRepository $bidRepository, Request $request, Book $book): Response
    {
        $bid = new Bid();

        $title = $book->getTitle(); // get title of current book
        $bidder = $this->getUser(); // set currently logged in user as the bidder
        $bid->setBuyer($bidder);
        $bid->setAuctionItem($book); // set current book as the auction item

        $form = $this->createForm(BidType::class, $bid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentHighestBid = $bidRepository->findOneBy(['auctionItem' => $book], ['timestamp' => "DESC"]); // find the latest bid
            $currentBidder= $bidRepository->findOneBy(['buyer' => $bidder]); // find the latest bid

            // compare bid specified by buyer to current highest bid
            if(isset($currentHighestBid)) {
                if($bid->getAmount() <= $currentHighestBid->getAmount()) {
                    $this->addFlash('error', 'Bidding error - amount must be higher than the current highest bid.');

                    return $this->redirectToRoute('bid_new', [
                        'id' => $book->getId(),
                    ]);
                }
                if(isset($currentBidder)) {
                    $this->addFlash('error', 'Bidding error - duplicate record found for auction item "' . $book->getTitle() . '"');

                    return $this->redirectToRoute('bid_index');
                }
            }
            // compare bid specified by buyer to starting price
            else {
                if ($bid->getAmount() < $book->getStartingPrice()) {
                    $this->addFlash('error', 'Bidding error - amount must be higher than or equal to the starting price.');

                    return $this->redirectToRoute('bid_new', [
                        'id' => $book->getId(),
                    ]);
                }
            }

            // set timestamp
            $dateTime = $form->get('timestamp')->getData();
            $bid->setTimestamp($dateTime);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bid);
            $entityManager->flush();

            $this->addFlash('success', 'Your bid has been placed - €' . $bid->getAmount() . ' on auction item "' . $book->getTitle() . '"');

            return $this->redirectToRoute('bid_index');

        }

        return $this->render('bid/new.html.twig', [
            'bid' => $bid,
            'form' => $form->createView(),
            'bids' => $bidRepository->findAll(),
            'bookTitle' => $title,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bid_edit", methods={"GET","POST"})
     */
    public function editAction(BidRepository $bidRepository, Request $request, Bid $bid): Response
    {
        $title = $bid->getAuctionItem();
        $form = $this->createForm(BidType::class, $bid);
        $currentBid = $bidRepository->findOneBy(['auctionItem' => $title], ['timestamp' => "DESC"]); // find the latest bid
        $currentHighestBid = $currentBid->getAmount();
        $currentHighestBidder = $currentBid->getBuyer();
        $bidder = $this->getUser(); // get currently logged in user

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // for when user places bid on the same item
            if(isset($currentBid)) {
                if($bid->getAmount() <= $currentHighestBid) {
                    $this->addFlash('error', 'Bidding error - amount must be higher than the current highest bid.');

                    return $this->redirectToRoute('bid_edit', [
                        'id' => $bid->getId(),
                    ]);
                }
                elseif($bidder == $currentHighestBidder) {
                    $this->addFlash('error', 'Bidding error - you have already placed the highest bid.');

                    return $this->redirectToRoute('bid_edit', [
                        'id' => $bid->getId(),
                    ]);
                }
            }

            // set timestamp
            $dateTime = $form->get('timestamp')->getData();
            $bid->setTimestamp($dateTime);

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Your bid has been updated - €' . $bid->getAmount() . ' on auction item "' . $bid->getAuctionItem()->getTitle() . '"');

            return $this->redirectToRoute('bid_index');
        }

        return $this->render('bid/edit.html.twig', [
            'bid' => $bid,
            'form' => $form->createView(),
            'bids' => $bidRepository->findAll(),
            'bookTitle' => $title,
        ]);
    }

    /**
     * @Route("/{id}", name="bid_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, Bid $bid): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bid->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bid);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bid_index');
    }
}
