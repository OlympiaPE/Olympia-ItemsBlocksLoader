<?php

namespace Olympia\items\tools\swords\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\items\tools\swords\BaseSword;
use Olympia\Kitmap\managers\Managers;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\ItemIdentifier;

final class MithrilSword extends BaseSword
{
    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD);
        $this->initComponent("mithril_sword", $creativeInfo);

        $this->setCustomName("§r§fEpée en mithril");
        $this->addComponent(new IconComponent("mithril_sword"));
    }

    /**
     * @return int
     */
    public function getMaxDurability(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_sword.durability");
    }

    public function getAttackPoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.mithril_sword.damage");
    }
}