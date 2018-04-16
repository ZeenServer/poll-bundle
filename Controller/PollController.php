<?php

namespace Zeen\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PollController extends Controller
{


    /**
     * @return \Zeen\PollBundle\Manager\PollManager
     */
    protected function getPollManager()
    {
        return $this->get('Zeen.poll');
    }

    public function voteAction(Request $request)
    {
        $pv = intval($request->get('pv'));
        $pollManager = $this->getPollManager();


        if (!$pv) return $this->emptyResponse();
        $answer = $this->getDoctrine()->getRepository('ApplicationZeenPollBundle:PollAnswer')->find($pv);

        if (!$answer) return $this->emptyResponse();
        $poll = $answer->getPoll();


        if (!$pollManager->canVote($poll, $request)) return $this->allreadyVoteResponse();


        $pollManager->processVote($answer, $request );


        //Refresh data
        $poll = $this->getDoctrine()->getRepository('ApplicationZeenPollBundle:Poll')->find ($poll->getId());

        $response =  $this->pollResultResponse($poll, $request, true);


        $pollManager->setResponseCoookie ($poll,$response);

        return $response;

    }


    public function emptyResponse()
    {
        return new Response ('');
    }

    public function pollBlockAction(Request $request, $isVote = null)
    {
        return $this->pollResultResponse(
            $this->getDoctrine()->getRepository('ApplicationZeenPollBundle:Poll')->getCurrent(), $request, $isVote);
    }


    public function pollResultResponse($poll, Request $request, $isVote = null)
    {
        return $this->render('ZeenPollBundle:Poll:pollBlock.html.twig', [
            'isVote' => is_null($isVote) ? $this->getPollManager()->isVote($poll, $request) : $isVote,
            'poll' => $poll
        ]);
    }
}
