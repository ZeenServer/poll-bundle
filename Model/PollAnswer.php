<?php
namespace Zeen\ZeenPollBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


abstract class PollAnswer
{
    protected $title;


    protected $description;


    /**
     * @var \Zeen\PollBundle\Model\Poll;
     */
    protected $poll;


    protected $votesNum;

    protected $pos;


    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param \Zeen\PollBundle\Model\Poll $poll
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;
        return $this;
    }

    /**
     * @return \Zeen\PollBundle\Model\Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * @param mixed $votesNum
     */
    public function setVotesNum($votesNum)
    {
        $this->votesNum = $votesNum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVotesNum()
    {
        return $this->votesNum;
    }

    /**
     * @param mixed $pos
     */
    public function setPos($pos)
    {
        $this->pos = $pos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPos()
    {
        return $this->pos;
    }






}