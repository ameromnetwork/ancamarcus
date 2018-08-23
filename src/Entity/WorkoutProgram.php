<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkoutProgramRepository")
 */
class WorkoutProgram
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var WorkoutProgram
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkoutProgram", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\WorkoutProgram", mappedBy="parent", cascade={"persist", "remove"})
     */
    private $children;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="media_url", type="text", nullable=false)
     */
    private $mediaUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="media_body", type="string", length=100, nullable=true)
     */
    private $mediaBody;

    /**
     * @var array
     *
     * @ORM\Column(name="data", type="json", nullable=true)
     */
    private $data;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="workoutPrograms", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * WorkoutProgram constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return WorkoutProgram
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return WorkoutProgram
     */
    public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * @param WorkoutProgram $parent
     *
     * @return WorkoutProgram
     */
    public function setParent(self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     *
     * @return WorkoutProgram
     */
    public function setChildren(ArrayCollection $children): self
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return WorkoutProgram
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return WorkoutProgram
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaUrl(): string
    {
        return $this->mediaUrl;
    }

    /**
     * @param string $mediaUrl
     *
     * @return WorkoutProgram
     */
    public function setMediaUrl(string $mediaUrl): self
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediaBody(): string
    {
        return $this->mediaBody;
    }

    /**
     * @param string $mediaBody
     *
     * @return WorkoutProgram
     */
    public function setMediaBody(string $mediaBody): self
    {
        $this->mediaBody = $mediaBody;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return WorkoutProgram
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return WorkoutProgram
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
