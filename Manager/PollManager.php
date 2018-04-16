<?php
namespace Zeen\ZeenPollBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Cookie;

class PollManager {

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getPollRepository()
    {

    }

    public function isVote ($poll, $request)
    {

       // print $request->cookies->get ('voted').'-'.$poll->getId();
       return $request->cookies->get ('voted') && intval($request->cookies->get ('voted')) == $poll->getId();

    }


    public function canVote ($poll, $request)
    {
       return !$this->isVote($poll, $request);
    }

    public function processVote ($answer, $request)
    {

        if ($this->canVote($answer, $request))
        {

            $answer->setVotesNum( $answer->getVotesNum()+1);
            $this->entityManager->persist($answer);
            $this->entityManager->flush();
        }



        return true;

    }


    public function setResponseCoookie ($poll,$response)
    {

        $response->headers->setCookie(new Cookie('voted', $poll->getId(), time() +
            (3600 * 24* 50)));


    }


} 