<?php

namespace PolskaScena\SyliusAffiliatePlugin\User\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PolskaScena\SyliusAffiliatePlugin\Affiliate\Entity\AffiliateCustomers;
use PolskaScena\SyliusAffiliatePlugin\Affiliate\Entity\AffiliateUsers;
use Sylius\Component\Core\Model\ShopUser as BaseUser;
/**
 * @ORM\Entity()
 * @ORM\Table(name="sylius_shop_user")
 */
class ShopUser extends BaseUser
{
    /**
     * @var AffiliateCustomers|null
     *
     * @ORM\OneToOne(targetEntity="PolskaScena\SyliusAffiliatePlugin\Entity\Affiliate\AffiliateCustomers", mappedBy="user")
     */
    private $affiliateCustomer;

    /**
     * @var Collection|AffiliateUsers[]
     *
     * @ORM\OneToMany(targetEntity="PolskaScena\SyliusAffiliatePlugin\Entity\Affiliate\AffiliateUsers", mappedBy="user")
     */
    private $affiliateUsers;

    public function __construct()
    {
        parent::__construct();
        $this->affiliateUsers = new ArrayCollection();
    }

    /**
     * @return AffiliateCustomers|null
     */
    public function getAffiliateCustomer(): ?AffiliateCustomers
    {
        return $this->affiliateCustomer;
    }

    public function setAffiliateCustomer(?AffiliateCustomers $affiliateCustomer): void
    {
        if ($affiliateCustomer && $affiliateCustomer->getUser() !== $this) {
            $affiliateCustomer->setUser($this);
        }

        $this->affiliateCustomer = $affiliateCustomer;
    }

    /**
     * @return Collection|AffiliateUsers[]
     */
    public function getAffiliateUsers(): Collection
    {
        return $this->affiliateUsers;
    }

    public function addAffiliateUser(AffiliateUsers $affiliateUser): void
    {
        if (!$this->affiliateUsers->contains($affiliateUser)) {
            $this->affiliateUsers[] = $affiliateUser;
            $affiliateUser->setUser($this);
        }
    }

    public function removeAffiliateUser(AffiliateUsers $affiliateUser): void
    {
        if ($this->affiliateUsers->contains($affiliateUser)) {
            $this->affiliateUsers->removeElement($affiliateUser);
            if ($affiliateUser->getUser() === $this) {
                $affiliateUser->setUser(null);
            }
        }
    }
}
