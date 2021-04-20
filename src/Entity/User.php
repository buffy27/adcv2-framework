<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\UserClass;
use function Symfony\Component\Translation\t;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`users`")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private $username;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", name="passhash", nullable=true)
     */
    private $password;

    /**
     * @var string The secret for password
     * @ORM\Column(type="string", name="secret", nullable=true)
     */
    private $secret;

    /**
     * @ORM\OneToMany(targetEntity=Torrents::class, mappedBy="owner")
     *
     */
    private $torrents;

    /**
     * @ORM\Column(type="array", name="tracker_settings", nullable=true)
     */
    private array $trackerSettings = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Countries::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $idCountry;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $forumSettings = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $personalSettings = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $banned;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $downloaded;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $uploaded;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $passkey;

    /**
     * @ORM\ManyToOne(targetEntity=Language::class, inversedBy="users")
     * @ORM\JoinColumn (nullable=true)
     */
    private $idLanguage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $added;

    /**
     * @ORM\OneToMany(targetEntity=TorrentComments::class, mappedBy="user")
     */
    private $idComment;

    /**
     * @ORM\OneToMany(targetEntity=News::class, mappedBy="addedBy")
     */
    private $news;

    /**
     * @var Collection | UserClass[]
     * @ORM\ManyToMany(targetEntity="App\Entity\UserClass")
     * @ORM\JoinTable(
     *      name="user_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=SyncAnnounce::class, mappedBy="user")
     */
    private $syncAnnounces;

    /**
     * @ORM\OneToMany(targetEntity=Peers::class, mappedBy="user")
     */
    private $peers;

    /**
     * @ORM\ManyToOne(targetEntity=Titles::class, inversedBy="users")
     */
    private $idTitle;

    /**
     * @ORM\Column(type="datetime", nullable=True)
     */
    private $last_action;

    /**
     * @ORM\OneToMany(targetEntity=Invites::class, mappedBy="inviter")
     */
    private $invites;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userInvites;

    /**
     * @ORM\OneToMany(targetEntity=XbtFilesUsers::class, mappedBy="uid")
     */
    private $fid;

    /**
     * @ORM\OneToMany(targetEntity=XbtFilesUsers::class, mappedBy="uid")
     */
    private $xbtFilesUsers;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $visible;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $can_leech;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $track_ipv6;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $UploadedDaily;

    /**
     * @ORM\Column(type="bigint", options={"default":0})
     */
    private $DownloadedDaily;

    public function __construct()
    {
        $this->torrents = new ArrayCollection();
        $this->idComment = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->syncAnnounces = new ArrayCollection();
        $this->peers = new ArrayCollection();
        $this->invites = new ArrayCollection();
        $this->fid = new ArrayCollection();
        $this->xbtFilesUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = $this->roles->toArray();
        $roles = $roles[0];
        return $roles->getRoles();
    }

    public function setRoles(Collection $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function setRole(UserClass $role)
    {
        $this->roles->add($role);
    }

    public function getUserClass(){
        return $this->roles->toArray()[0];
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

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Torrents[]
     */
    public function getTorrents(): Collection
    {
        return $this->torrents;
    }

    public function addTorrent(Torrents $torrent): self
    {
        if (!$this->torrents->contains($torrent)) {
            $this->torrents[] = $torrent;
            $torrent->setOwner($this);
        }

        return $this;
    }

    public function removeTorrent(Torrents $torrent): self
    {
        if ($this->torrents->removeElement($torrent)) {
            // set the owning side to null (unless already changed)
            if ($torrent->getOwner() === $this) {
                $torrent->setOwner(null);
            }
        }

        return $this;
    }

    public function getTrackerSettings(): ?array
    {
        return $this->trackerSettings;
    }

    public function setTrackerSettings(array $trackerSettings): self
    {
        $this->trackerSettings = $trackerSettings;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getIdCountry(): ?Countries
    {
        return $this->idCountry;
    }

    public function setIdCountry(?Countries $idCountry): self
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getForumSettings(): ?array
    {
        return $this->forumSettings;
    }

    public function setForumSettings(array $forumSettings): self
    {
        $this->forumSettings = $forumSettings;

        return $this;
    }

    public function getPersonalSettings(): ?array
    {
        return $this->personalSettings;
    }

    public function setPersonalSettings(array $personalSettings): self
    {
        $this->personalSettings = $personalSettings;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getBanned(): ?bool
    {
        return $this->banned;
    }

    public function setBanned(bool $banned): self
    {
        $this->banned = $banned;

        return $this;
    }

    public function getDownloaded(): ?string
    {
        return $this->downloaded;
    }

    public function setDownloaded(string $downloaded): self
    {
        $this->downloaded = $downloaded;

        return $this;
    }

    public function getUploaded(): ?string
    {
        return $this->uploaded;
    }

    public function setUploaded(string $uploaded): self
    {
        $this->uploaded = $uploaded;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getPasskey(): ?string
    {
        return $this->passkey;
    }

    public function setPasskey(string $passkey): self
    {
        $this->passkey = $passkey;

        return $this;
    }

    public function getIdLanguage(): ?Language
    {
        return $this->idLanguage;
    }

    public function setIdLanguage(?Language $idLanguage): self
    {
        $this->idLanguage = $idLanguage;

        return $this;
    }

    public function getAdded(): ?\DateTimeInterface
    {
        return $this->added;
    }

    public function setAdded(\DateTimeInterface $added = null): self
    {
        if(!$added)
            $this->added = new \DateTime('now');
        else
            $this->added = $added;

        return $this;
    }

    /**
     * @return Collection|TorrentComments[]
     */
    public function getIdComment(): Collection
    {
        return $this->idComment;
    }

    public function addIdComment(TorrentComments $idComment): self
    {
        if (!$this->idComment->contains($idComment)) {
            $this->idComment[] = $idComment;
            $idComment->setUser($this);
        }

        return $this;
    }

    public function removeIdComment(TorrentComments $idComment): self
    {
        if ($this->idComment->removeElement($idComment)) {
            // set the owning side to null (unless already changed)
            if ($idComment->getUser() === $this) {
                $idComment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->setAddedBy($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->removeElement($news)) {
            // set the owning side to null (unless already changed)
            if ($news->getAddedBy() === $this) {
                $news->setAddedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SyncAnnounce[]
     */
    public function getSyncAnnounces(): Collection
    {
        return $this->syncAnnounces;
    }

    public function addSyncAnnounce(SyncAnnounce $syncAnnounce): self
    {
        if (!$this->syncAnnounces->contains($syncAnnounce)) {
            $this->syncAnnounces[] = $syncAnnounce;
            $syncAnnounce->setUser($this);
        }

        return $this;
    }

    public function removeSyncAnnounce(SyncAnnounce $syncAnnounce): self
    {
        if ($this->syncAnnounces->removeElement($syncAnnounce)) {
            // set the owning side to null (unless already changed)
            if ($syncAnnounce->getUser() === $this) {
                $syncAnnounce->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Peers[]
     */
    public function getPeers(): Collection
    {
        return $this->peers;
    }

    public function addPeer(Peers $peer): self
    {
        if (!$this->peers->contains($peer)) {
            $this->peers[] = $peer;
            $peer->setUser($this);
        }

        return $this;
    }

    public function removePeer(Peers $peer): self
    {
        if ($this->peers->removeElement($peer)) {
            // set the owning side to null (unless already changed)
            if ($peer->getUser() === $this) {
                $peer->setUser(null);
            }
        }

        return $this;
    }

    public function getIdTitle(): ?Titles
    {
        return $this->idTitle;
    }

    public function setIdTitle(?Titles $idTitle): self
    {
        $this->idTitle = $idTitle;

        return $this;
    }

    public function getLastAction(): ?\DateTimeInterface
    {
        return $this->last_action;
    }

    public function setLastAction(\DateTimeInterface $last_action): self
    {
        $this->last_action = $last_action;

        return $this;
    }

    /**
     * @return Collection|Invites[]
     */
    public function getInvites(): Collection
    {
        return $this->invites;
    }

    public function addInvite(Invites $invite): self
    {
        if (!$this->invites->contains($invite)) {
            $this->invites[] = $invite;
            $invite->setInviter($this);
        }

        return $this;
    }

    public function removeInvite(Invites $invite): self
    {
        if ($this->invites->removeElement($invite)) {
            // set the owning side to null (unless already changed)
            if ($invite->getInviter() === $this) {
                $invite->setInviter(null);
            }
        }

        return $this;
    }

    public function setUserInvites(?int $Invites): self
    {
        $this->userInvites = $Invites;

        return $this;
    }
    public function getUserInvites()
    {
        return $this->userInvites;
    }

    /**
     * @return Collection|XbtFilesUsers[]
     */
    public function getFid(): Collection
    {
        return $this->fid;
    }

    public function addFid(XbtFilesUsers $fid): self
    {
        if (!$this->fid->contains($fid)) {
            $this->fid[] = $fid;
            $fid->setUid($this);
        }

        return $this;
    }

    public function removeFid(XbtFilesUsers $fid): self
    {
        if ($this->fid->removeElement($fid)) {
            // set the owning side to null (unless already changed)
            if ($fid->getUid() === $this) {
                $fid->setUid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|XbtFilesUsers[]
     */
    public function getXbtFilesUsers(): Collection
    {
        return $this->xbtFilesUsers;
    }

    public function addXbtFilesUser(XbtFilesUsers $xbtFilesUser): self
    {
        if (!$this->xbtFilesUsers->contains($xbtFilesUser)) {
            $this->xbtFilesUsers[] = $xbtFilesUser;
            $xbtFilesUser->setUid($this);
        }

        return $this;
    }

    public function removeXbtFilesUser(XbtFilesUsers $xbtFilesUser): self
    {
        if ($this->xbtFilesUsers->removeElement($xbtFilesUser)) {
            // set the owning side to null (unless already changed)
            if ($xbtFilesUser->getUid() === $this) {
                $xbtFilesUser->setUid(null);
            }
        }

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(?bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCanLeech(): ?bool
    {
        return $this->can_leech;
    }

    public function setCanLeech(?bool $can_leech): self
    {
        $this->can_leech = $can_leech;

        return $this;
    }

    public function getTrackIpv6(): ?bool
    {
        return $this->track_ipv6;
    }

    public function setTrackIpv6(?bool $track_ipv6): self
    {
        $this->track_ipv6 = $track_ipv6;

        return $this;
    }

    public function getUploadedDaily(): ?string
    {
        return $this->UploadedDaily;
    }

    public function setUploadedDaily(string $UploadedDaily): self
    {
        $this->UploadedDaily = $UploadedDaily;

        return $this;
    }

    public function getDownloadedDaily(): ?string
    {
        return $this->DownloadedDaily;
    }

    public function setDownloadedDaily(string $DownloadedDaily): self
    {
        $this->DownloadedDaily = $DownloadedDaily;

        return $this;
    }
}
