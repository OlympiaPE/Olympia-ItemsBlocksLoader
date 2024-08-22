<?php

namespace Olympia\items\tools\swords\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\items\tools\swords\DashSword;
use Olympia\Loader;
use Olympia\utils\GlobalConstants;
use pocketmine\item\ItemIdentifier;

final class InfinitySword extends DashSword
{
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD);
        $this->initComponent("infinity_sword", $creativeInfo);

        $this->setCustomName("§r§tEpée de l'infini");
        $this->addComponent(new IconComponent("infinity_sword"));
    }

    public function getMaxDurability(): int
    {
        return GlobalConstants::ITEM_MAX_DURABILITY;
    }

    public function getAttackPoints(): int
    {
        return Loader::getInstance()->getConfigManager()->getNested("orichalque_sword.damage");
    }
}