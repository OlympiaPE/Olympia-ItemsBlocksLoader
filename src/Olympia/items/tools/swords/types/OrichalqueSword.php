<?php

namespace Olympia\items\tools\swords\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\items\tools\swords\DashSword;
use Olympia\Kitmap\managers\Managers;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;

final class OrichalqueSword extends DashSword
{
    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD);
        $this->initComponent("orichalque_sword", $creativeInfo);

        $this->setCustomName("§r§fEpée en orichalque");
        $this->addComponent(new IconComponent("orichalque_sword"));
    }

    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_sword.durability");
    }

    public function getAttackPoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_sword.damage");
    }
}