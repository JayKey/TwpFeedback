<?php

namespace Twp\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer") 
     */
    protected $glueId;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    
    // Relations
    
    /**
     * @ORM\OneToMany(targetEntity="Idea", mappedBy="user")
     */
    protected $ideas;
    
    /**
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="user")
     */
    protected $votes;
    
    /**
     * @ORM\OneToMany(targetEntity="Status", mappedBy="user")
     */
    protected $statuses;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
     */
    protected $comments;
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
       $this->createdAt = new \DateTime();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ideas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->votes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statuses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set glueId
     *
     * @param integer $glueId
     * @return User
     */
    public function setGlueId($glueId)
    {
        $this->glueId = $glueId;
    
        return $this;
    }

    /**
     * Get glueId
     *
     * @return integer 
     */
    public function getGlueId()
    {
        return $this->glueId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add ideas
     *
     * @param Twp\Entity\Idea $ideas
     * @return User
     */
    public function addIdea(\Twp\Entity\Idea $ideas)
    {
        $this->ideas[] = $ideas;
    
        return $this;
    }

    /**
     * Remove ideas
     *
     * @param Twp\Entity\Idea $ideas
     */
    public function removeIdea(\Twp\Entity\Idea $ideas)
    {
        $this->ideas->removeElement($ideas);
    }

    /**
     * Get ideas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdeas()
    {
        return $this->ideas;
    }

    /**
     * Add votes
     *
     * @param Twp\Entity\Vote $votes
     * @return User
     */
    public function addVote(\Twp\Entity\Vote $votes)
    {
        $this->votes[] = $votes;
    
        return $this;
    }

    /**
     * Remove votes
     *
     * @param Twp\Entity\Vote $votes
     */
    public function removeVote(\Twp\Entity\Vote $votes)
    {
        $this->votes->removeElement($votes);
    }

    /**
     * Get votes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVotes()
    {
        return $this->votes;
    }

    /**
     * Add statuses
     *
     * @param Twp\Entity\Status $statuses
     * @return User
     */
    public function addStatuse(\Twp\Entity\Status $statuses)
    {
        $this->statuses[] = $statuses;
    
        return $this;
    }

    /**
     * Remove statuses
     *
     * @param Twp\Entity\Status $statuses
     */
    public function removeStatuse(\Twp\Entity\Status $statuses)
    {
        $this->statuses->removeElement($statuses);
    }

    /**
     * Get statuses
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * Add comments
     *
     * @param Twp\Entity\Comment $comments
     * @return User
     */
    public function addComment(\Twp\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param Twp\Entity\Comment $comments
     */
    public function removeComment(\Twp\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}