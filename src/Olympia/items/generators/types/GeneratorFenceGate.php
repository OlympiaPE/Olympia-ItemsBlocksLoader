<?php

namespace Olympia\items\generators\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\items\generators\BaseGenerator;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;

final class GeneratorFenceGate extends BaseGenerator
{
    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE);
        $this->initComponent("generator_fencegate", $creativeInfo);

        $this->setCustomName("§r§fGénérateur de portillon");
        $this->addComponent(new IconComponent("generator_fencegate"));
    }

    public function getBlockGenerated(Player $player): Block
    {
        return VanillaBlocks::OAK_FENCE_GATE()->setFacing($player->getHorizontalFacing())->setOpen($player->isSneaking());
    }
}