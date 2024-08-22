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

class Levitation extends Item implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Levitation")
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT);
        $this->initComponent("levitation", $creativeInfo);

        $this->setCustomName("§r§6Lévitation");
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));

        $this->addComponent(new IconComponent("levitation"));
        
        $this->setLore([
            "",
            "§7Clique droit pour obtenir",
            "§7un effet de §6Lévitation",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        /** @var Session $player */
        if(!$player->canUseItem()) {
            return ItemUseResult::FAIL();
        }

        if(!$player->getCooldowns()->hasCooldown(SessionCooldowns::COOLDOWN_LEVITATION)) {
            $player->getEffects()->add(new EffectInstance(VanillaEffects::LEVITATION(), 5*20, 0, false));
            $player->sendMessage("§6» §fVous venez d'utiliser l'item §6Lévitation §f!");
            $player->getCooldowns()->setCooldown(SessionCooldowns::COOLDOWN_LEVITATION, 30);
            $this->pop();
            return ItemUseResult::SUCCESS();
        }else{
            $cooldown = $player->getCooldowns()->getCooldown(SessionCooldowns::COOLDOWN_LEVITATION);
            $player->sendMessage("§6» §fVous devez attendre $cooldown secondes avant de pouvoir réutiliser cet item.");
            return ItemUseResult::FAIL();
        }
    }
}