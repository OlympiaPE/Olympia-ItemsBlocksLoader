<?php

namespace Olympia\items\partners;

use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\session\Session;
use Olympia\Kitmap\session\SessionCooldowns;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class Resistance extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Resistance")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("resistance", $creativeInfo);

        $this->setCustomName("§r§6Résistance");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));

        $this->addComponent(new IconComponent("resistance"));
        
        $this->setLore([
            "",
            "§7Clique droit pour obtenir",
            "§7un effet de §6Résistance 3",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */
        if(!$player->canUseItem()) {
            return ItemUseResult::FAIL();
        }

        if(!$player->getCooldowns()->hasCooldown(SessionCooldowns::COOLDOWN_RESISTANCE)) {
            $player->getEffects()->add(new EffectInstance(VanillaEffects::RESISTANCE(), 9*20, 2, false));
            $player->sendMessage("§6» §fVous venez d'utiliser l'item §6Résistance §f!");
            $player->getCooldowns()->setCooldown(SessionCooldowns::COOLDOWN_RESISTANCE, 30);
            $this->pop();
            return ItemUseResult::SUCCESS();
        }else{
            $cooldown = $player->getCooldowns()->getCooldown(SessionCooldowns::COOLDOWN_RESISTANCE);
            $player->sendMessage("§6» §fVous devez attendre $cooldown secondes avant de pouvoir réutiliser cet item.");
            return ItemUseResult::FAIL();
        }
    }
}