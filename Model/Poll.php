<?php
namespace Iphp\PollBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


abstract class Poll
{
    protected $title;

    protected $slug = null;

    protected $description;


    protected $enabled;

    protected $publicationDateStart;

    protected $createdAt;

    protected $updatedAt;

    protected $answerVotesNum = null;


    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface;
     */
    protected $updatedBy;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface;
     */
    protected $createdBy;


    protected $date;

    /**
     * @var \Iphp\PollBundle\Model\PollAnswer[];
     */
    protected $answers;

    function __toString()
    {
        return (string)$this->getTitle();
    }


    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

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
     * @param mixed $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param mixed $publicationDateStart
     */
    public function setPublicationDateStart($publicationDateStart)
    {
        $this->publicationDateStart = $publicationDateStart;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublicationDateStart()
    {
        return $this->publicationDateStart;
    }

    /**
     * @param null $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return null
     */
    public function getSlug()
    {
        return $this->slug;
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
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \Symfony\Component\Security\Core\User\UserInterface $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }


    /**
     * @return \Iphp\PollBundle\Model\PollAnswer[]
     */
    public function getAnswers()
    {
        return $this->answers;
    }


    public function setAnswers($answers)
    {
        foreach ($answers as $answer) $answer->setPoll($this);

        foreach ($this->getAnswers() as $answer) {
            if (!$answers->contains($answer)) {
                $this->getAnswers()->removeElement($answer);
            }
        }

        $this->answers = $answer;
        return $this;
    }


    public function addAnswer(PollAnswer $answer)
    {
        $answer->setPoll($this);
        $this->answers[] = $answer;
    }


    public function removeAnswer($answer)
    {
        $this->getAnswers()->removeElement($answer);
    }


    public function getAnswerPercent($answer)
    {
       if (is_null ($this->answerVotesNum))
       {
           foreach ($this->getAnswers() as $a)
               $this->answerVotesNum+= intval($a->getVotesNum());
       }

        return $this->answerVotesNum ? (intval($answer->getVotesNum()) / $this->answerVotesNum)* 100 : null;
    }
}