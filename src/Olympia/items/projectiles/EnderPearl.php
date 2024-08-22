<?php

namespace Olympia\items\projectiles;

use customiesdevs\customies\item\component\CanDestroyInCreativeComponent;
use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ProjectileItem;
use pocketmine\player\Player;
use pocketmine\entity\projectile\EnderPearl as EnderPearlEntity;

class EnderPearl extends ProjectileItem implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("ender_pearl", $creativeInfo);

        $this->addComponent(new MaxStackSizeComponent($this->getMaxStackSize()));
        $this->addComponent(new IconComponent("ender_pearl"));
        $this->addComponent(new DisplayNameComponent("Ender Pearl"));
        $this->addComponent(new CanDestroyInCreativeComponent(0));
    }

    public function getMaxStackSize(): int
    {
        return 16;
    }

    protected function createEntity(Location $location, Player $thrower): Throwable
    {
        return new EnderPearlEntity($location, $thrower);
    }

    public function getThrowForce(): float
    {
        return 1.5;
    }

    public function getCooldownTicks(): int
    {
        return 15;
    }
}