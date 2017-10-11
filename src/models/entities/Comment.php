<?php
namespace KPM\Entities;

/**
 * @Entity(repositoryClass="KPM\Repositories\CommentRepository")
 * @Table(name="comment")
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
     * @ManyToOne(targetEntity="PostIt", inversedBy="user_post_its")
     * @JoinColumn(name="post_it_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\PostIt
     */
    protected $post_it;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="comments")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *
     * @var KPM\Entities\User
     */
    protected $user;

    /**
     * @Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $created_at;

    /**
     * @Column(type="datetime", nullable=true)
     *
     * @var DateTime
     */
    protected $updated_at;


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
        return $this->post_it;
    }

    public function setPostIt(PostIt $post_it)
    {
        $post_it->addComment($this);
        $this->post_it = $post_it;
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

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}
