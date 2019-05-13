<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    
    /**
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="BlogPost", mappedBy="categories")
     * @var Collection
     */
    private $blogPosts;

    public function __construct()
    {
        $this->blogPosts = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getBlogPosts(): Collection
    {
        return $this->blogPosts;
    }

    /**
     * @param BlogPost $blogPost
     */
    public function addBlogPost(BlogPost $blogPost): void
    {
        // First we check if we already have this blog post in our collection
        if ($this->blogPosts->contains($blogPost)) {
            // Do nothing if its already part of our collection
            return;
        }
        // Add blog post to our array collection
        $this->blogPosts->add($blogPost);
        // We also add this category to the blog post. This way both entities are 'linked' together.
        // In a manyToMany relationship both entities need to know that they are linked together.
        $blogPost->addCategory($this);
    }

    /**
     * @param BlogPost $blogPost
     */
    public function removeBlogPost(BlogPost $blogPost): void
    {
        // If the blog post does not exist in the collection, then we don't need to do anything
        if (!$this->blogPosts->contains($blogPost)) {
            return;
        }
        // Remove blog post from the collection
        $this->blogPosts->removeElement($blogPost);
        // Also remove this from the category collection of the blog post
        $blogPost->removeCategory($this);
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return BlogPost
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        
        return $this;
    }
    
    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if (!$this->getCreatedAt()) {
            $this->setCreatedAt(new \DateTime());
        }

        if (!$this->getUpdatedAt()) {
            $this->setUpdatedAt(new \DateTime());
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    public function __toString()
    {
        return (string) $this->title;
    }
}
