<?php

namespace Olympia\items\tools\pickaxes\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\items\tools\pickaxes\SimplePickaxe;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;

final class VulcainPickaxe extends SimplePickaxe
{
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name, ToolTier::NETHERITE);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_PICKAXE);
        $this->initComponent("vulcain_pickaxe", $creativeInfo);

        $this->setCustomName("§r§tPioche de Vulcain");
        $this->addComponent(new IconComponent("vulcain_pickaxe"));

        $this->setUnbreakable();
    }

    public function keepOnDeath(): bool
    {
        return true;
    }
}