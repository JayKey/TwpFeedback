<?php

namespace Twp\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $content;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $user;
    
    // Relations
    
    /**
     * @ORM\ManyToMany(targetEntity="Idea", inversedBy="comments", cascade={"remove"})
     * @ORM\JoinTable(name="idea_comments", 
     *      joinColumns={@ORM\JoinColumn(name="idea_id", onDelete="CASCADE", unique=true)},
     *      inverseJoinColumns={@ORM\JoinColumn(name="comment_id", onDelete="CASCADE")}
     * )
     */
    protected $idea;
    
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
        $this->idea = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Comment
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
     * Set user
     *
     * @param Twp\Entity\User $user
     * @return Comment
     */
    public function setUser(\Twp\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Twp\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add idea
     *
     * @param Twp\Entity\Idea $idea
     * @return Comment
     */
    public function setIdea(\Twp\Entity\Idea $idea)
    {
        $this->idea = new \Doctrine\Common\Collections\ArrayCollection(array($idea));
    
        return $this;
    }

    /**
     * Remove idea
     *
     * @param Twp\Entity\Idea $idea
     */
    public function removeIdea(\Twp\Entity\Idea $idea)
    {
        $this->idea->removeElement($idea);
    }

    /**
     * Get idea
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdea()
    {
        return $this->idea;
    }
}