<?php

namespace PolskaScena\SyliusAffiliatePlugin\User\Entity;

use Doctrine\Common\Collections\Collection;
use PolskaScena\SyliusAffiliatePlugin\Affiliate\Entity\AffiliateCustomers;
use PolskaScena\SyliusAffiliatePlugin\Affiliate\Entity\AffiliateUsers;
use Sylius\Component\Core\Model\ShopUserInterface as BaseShopUserInterface;

interface ShopUserInterface extends BaseShopUserInterface
{
    public function getAffiliateCustomer(): ?AffiliateCustomers;

    public function setAffiliateCustomer(?AffiliateCustomers $affiliateCustomer): void;

    public function getAffiliateUsers(): Collection;

    public function addAffiliateUser(AffiliateUsers $affiliateUser): void;

    public function removeAffiliateUser(AffiliateUsers $affiliateUser): void;

}
