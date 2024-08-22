<?php

namespace Olympia\items\projectiles;

use customiesdevs\customies\item\component\CanDestroyInCreativeComponent;
use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\session\Session;
use Olympia\Kitmap\session\SessionCooldowns;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\item\ProjectileItem;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use Olympia\Kitmap\entities\projectiles\EnderPearl as EnderPearlEntity;

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

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */

        if(!$player->canUsePearl()) {
            $player->sendMessage("§6» §fVous ne pouvez pas utiliser cela ici.");
            return ItemUseResult::FAIL;
        }

        if (!is_null($player->getAntiPearlTime())) {
            $time = time() - $player->getAntiPearlTime();
            if ($time <= 35) {
                $player->sendMessage("§6» §4Vous ne pouvez pas utiliser vos perles pendant encore " . 35 - $time . " secondes.");
                return ItemUseResult::FAIL;
            }
        }

        if(!$player->getCooldowns()->hasCooldown(SessionCooldowns::COOLDOWN_PEARL)) {

            $player->getCooldowns()->setCooldown(SessionCooldowns::COOLDOWN_PEARL, 15, "§6» §fVous avez un cooldown de perle pendant 15 secondes.", "§6» §fVous n'avez plus de cooldown perle !");
            return parent::onClickAir($player, $directionVector, $returnedItems);
        }else{

            $cooldown = $player->getCooldowns()->getCooldown(SessionCooldowns::COOLDOWN_PEARL);
            $player->sendMessage("§6» §fVous avez un cooldown de perle pendant encore $cooldown secondes.");
            return ItemUseResult::FAIL;
        }
    }
}