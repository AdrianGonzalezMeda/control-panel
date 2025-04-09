<?php

namespace App\Entity\Admin;

use App\Repository\Admin\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\Index(name: "idx_user_username", columns: ["username"])]
#[ORM\Index(name: "idx_user_email", columns: ["email"])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $password = null;

    /**
     * @var string Username
     */
    #[ORM\Column(type: 'string', length: 150)]
    private ?string $username = null;

    /**
     * @var \DateTimeImmutable stores the time when the user was created
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $created = null;

    /**
     * @var \DateTimeInterface stores the time when the user was modified
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $modified = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $created_by_user = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?self $modified_by_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getCreated(): ?\DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(\DateTimeImmutable $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getModified(): ?\DateTimeInterface
    {
        return $this->modified;
    }

    public function setModified(\DateTimeInterface $modified): static
    {
        $this->modified = $modified;

        return $this;
    }

    public function getCreatedByUser(): ?self
    {
        return $this->created_by_user;
    }

    public function setCreatedByUser(?self $created_by_user): static
    {
        $this->created_by_user = $created_by_user;

        return $this;
    }

    public function getModifiedByUser(): ?self
    {
        return $this->modified_by_user;
    }

    public function setModifiedByUser(?self $modified_by_user): static
    {
        $this->modified_by_user = $modified_by_user;

        return $this;
    }
}
