<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(type="string", unique=false)
     */
    private $password;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", unique=false)
     */
    private $apiKey;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $facebookId;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\WorkoutProgram", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $workoutPrograms;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->apiKey = \sha1(\uniqid().\time());
        $this->workoutPrograms = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return mixed
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     *
     * @return User
     */
    public function setApiKey($apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFacebookId(): ? string
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $facebookId
     *
     * @return User
     */
    public function setFacebookId($facebookId): self
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getWorkoutPrograms(): ?\Doctrine\Common\Collections\ArrayCollection
    {
        return $this->workoutPrograms;
    }

    public function addWorkoutProgram(WorkoutProgram $workoutProgram): self
    {
        $workoutProgram->setUser($this);

        $this->workoutPrograms->add($workoutProgram);

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $workoutPrograms
     *
     * @return User
     */
    public function setWorkoutPrograms(\Doctrine\Common\Collections\ArrayCollection $workoutPrograms): self
    {
        $this->workoutPrograms = $workoutPrograms;

        return $this;
    }
}
