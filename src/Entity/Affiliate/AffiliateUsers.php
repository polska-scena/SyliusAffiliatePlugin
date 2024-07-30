<?php

namespace PolskaScena\SyliusAffiliatePlugin\Affiliate\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PolskaScena\SyliusAffiliatePlugin\User\Entity\ShopUser;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="polskascena_affiliate_users")
 */
class AffiliateUsers
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ShopUser
     *
     * @ORM\OneToOne(targetEntity="PolskaScena\SyliusAffiliatePlugin\Entity\User\ShopUser", inversedBy="affiliateUser")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @var Collection|AffiliateCustomers[]
     *
     * @ORM\OneToMany(targetEntity="PolskaScena\SyliusAffiliatePlugin\Entity\Affiliate\AffiliateCustomers", mappedBy="affiliatedBy")
     */
    private $referredCustomers;

    public function __construct()
    {
        $this->referredCustomers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ShopUser
    {
        return $this->user;
    }

    public function setUser(ShopUser $user): void
    {
        $this->user = $user;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return Collection|AffiliateCustomers[]
     */
    public function getReferredCustomers(): Collection
    {
        return $this->referredCustomers;
    }

    public function addReferredCustomer(AffiliateCustomers $affiliateCustomer): void
    {
        if (!$this->referredCustomers->contains($affiliateCustomer)) {
            $this->referredCustomers[] = $affiliateCustomer;
            $affiliateCustomer->setAffiliatedBy($this);
        }
    }

    public function removeReferredCustomer(AffiliateCustomers $affiliateCustomer): void
    {
        if ($this->referredCustomers->contains($affiliateCustomer)) {
            $this->referredCustomers->removeElement($affiliateCustomer);
            if ($affiliateCustomer->getAffiliatedBy() === $this) {
                $affiliateCustomer->setAffiliatedBy(null);
            }
        }
    }


}
