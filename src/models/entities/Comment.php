<?php

namespace KPM\Entities;

/**
 * @Entity @Table(name="comment")
 */
class Comment
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", nullable=false, columnDefinition="TEXT")
     *
     * @var string
     */
    protected $text;

    /**
     * @ManyToOne(targetEntity="PostIt", inversedBy="userPostIts")
     *
     * @var KPM\Entities\PostIt
     */
    protected $postIt;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="comments")
     *
     * @var KPM\Entities\User
     */
    protected $user;


    // ************************************************************
    // GET and SET

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getPostIt()
    {
        return $this->postIt;
    }

    public function setPostIt(PostIt $postIt)
    {
        $postIt->addComment($this);
        $this->postIt = $postIt;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $user->addComment($this);
        $this->user = $user;
    }
}
