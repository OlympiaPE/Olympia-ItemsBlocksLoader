<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\entities\projectiles\Switchball as SnowballEntity;
use Olympia\Kitmap\session\Session;
use Olympia\Kitmap\session\SessionCooldowns;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\item\ProjectileItem;
use pocketmine\math\Vector3;
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
        return new SnowballEntity($location, $thrower);
    }

    public function getThrowForce(): float
    {
        return 1.5;
    }

    public function onClickAir(VanillaPlayer $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */
        if(!$player->canUseItem()) {
            return ItemUseResult::FAIL();
        }

        if($player->getCooldowns()->hasCooldown(SessionCooldowns::COOLDOWN_SWITCHBALL)) {
            $cooldown = $player->getCooldowns()->getCooldown(SessionCooldowns::COOLDOWN_SWITCHBALL);
            $player->sendMessage("§6» §fVous devez attendre $cooldown secondes avant de pouvoir réutiliser cet item.");
            return ItemUseResult::FAIL();
        }
        $player->getCooldowns()->setCooldown(SessionCooldowns::COOLDOWN_SWITCHBALL, 60);
        return parent::onClickAir($player, $directionVector, $returnedItems);
    }
}