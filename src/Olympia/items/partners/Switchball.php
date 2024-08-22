<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Snowball;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ProjectileItem;
use pocketmine\player\Player as VanillaPlayer;

class Switchball extends ProjectileItem implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Switchball")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("switchball", $creativeInfo);
        $this->addComponent(new MaxStackSizeComponent(16));

        $this->setLore([
            "",
            "§7Lancer l'item sur un",
            "§7un joueur pour échanger",
            "§7votre position avec lui",
        ]);
    }

    public function getMaxStackSize(): int
    {
        return 16;
    }

    protected function createEntity(Location $location, VanillaPlayer $thrower): Throwable
    {
        return new Snowball($location, $thrower);
    }

    public function getThrowForce(): float
    {
        return 1.5;
    }
}