<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\session\Session;
use Olympia\Kitmap\session\SessionCooldowns;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class Rocket extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Rocket")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("rocket", $creativeInfo);

        $this->setCustomName("§r§6Rocket");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));

        $this->addComponent(new IconComponent("rocket"));
        
        $this->setLore([
            "",
            "§7Clique droit pour se",
            "§7propulser vers le haut",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */
        if(!$player->canUseItem()) {
            return ItemUseResult::FAIL();
        }

        if(!$player->getCooldowns()->hasCooldown(SessionCooldowns::COOLDOWN_ROCKET)) {

            $motion = clone $player->getMotion();
            $motion->y += 0.069 * 50; /* multiplier * block height */
            $player->setMotion($motion);
            $player->sendMessage("§6» §fVous venez d'utiliser l'item §6Rocket §f!");
            $player->getCooldowns()->setCooldown(SessionCooldowns::COOLDOWN_ROCKET, 45);
            $this->pop();
            return ItemUseResult::SUCCESS();
        }else{

            $cooldown = $player->getCooldowns()->getCooldown(SessionCooldowns::COOLDOWN_ROCKET);
            $player->sendMessage("§6» §fVous devez attendre $cooldown secondes avant de pouvoir réutiliser cet item.");
            return ItemUseResult::FAIL();
        }
    }
}