<?php

namespace PolskaScena\SyliusAffiliatePlugin\Affiliate\Entity;

use Doctrine\ORM\Mapping as ORM;
use PolskaScena\SyliusAffiliatePlugin\User\Entity\ShopUser;

/**
 * @ORM\Entity()
 * @ORM\Table(name="polskascena_affiliate_customers")
 */
class AffiliateCustomers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var AffiliateUsers|null
     *
     * @ORM\ManyToOne(targetEntity="PolskaScena\SyliusAffiliatePlugin\Entity\Affiliate\AffiliateUsers", inversedBy="referredCustomers")
     * @ORM\JoinColumn(name="affiliated_by_id", referencedColumnName="id", nullable=true)
     */
    private $affiliatedBy;

    /**
     * @var ShopUser
     *
     * @ORM\OneToOne(targetEntity="PolskaScena\SyliusAffiliatePlugin\Entity\User\ShopUser", inversedBy="affiliateCustomer")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAffiliatedBy(): ?AffiliateUsers
    {
        return $this->affiliatedBy;
    }

    public function setAffiliatedBy(?AffiliateUsers $affiliatedBy): void
    {
        $this->affiliatedBy = $affiliatedBy;
    }

    public function getUser(): ShopUser
    {
        return $this->user;
    }

    public function setUser(ShopUser $user): void
    {
        $this->user = $user;
    }
}
