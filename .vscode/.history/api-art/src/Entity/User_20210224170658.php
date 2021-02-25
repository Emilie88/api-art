<?php
namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;


/**
 *@ApiResource()
 *  @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups("user:read")
     */
    private $id;

    /**
      * @Assert\NotBlank()
     * @Assert\Email()
     * @Groups({"user:read", "user:write", "comment:item:get","comment:write"})
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("user:read")
     */
    private $roles = [];

    /**
    
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups("user:write")
     */
    private $password;

   

    /**
     * @Assert\NotBlank()
    
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write"})
     */
    private $firstname;

    /**
     * @Assert\NotBlank()
    
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write"})
     */
    private $lastname;

    /**
     *  @ORM\OneToMany(targetEntity=Comment::class, mappedBy="owner")
     */
    private $commentsList;

    
    //  private $apiToken;
    

    
    public function __construct()
    {
        $this->commentsList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /*
     @Groups({"user:read", "user:write", "comment:item:get","comment:write"})
    */ 
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    // public function getApiToken(): ?string
    // {
    //     return $this->apiToken;
    // }

    // public function setApiToken(string $apiToken): self
    // {
    //     $this->apiToken = $apiToken;

    //     return $this;
    // }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getCommentsList(): Collection
    {
        return $this->commentsList;
    }

    public function addCommentsList(Comment $commentsList): self
    {
        if (!$this->commentsList->contains($commentsList)) {
            $this->commentsList[] = $commentsList;
            $commentsList->setOwner($this);
        }

        return $this;
    }

    public function removeCommentsList(Comment $commentsList): self
    {
        if ($this->commentsList->removeElement($commentsList)) {
            // set the owning side to null (unless already changed)
            if ($commentsList->getOwner() === $this) {
                $commentsList->setOwner(null);
            }
        }

        return $this;
    }

   

   

    // public function getPlainPassword(): ?string
    // {
    //     return $this->plainPassword;
    // }

    // public function setPlainPassword(string $plainPassword): self
    // {
    //     $this->plainPassword = $plainPassword;

    //     return $this;
    // }


}
