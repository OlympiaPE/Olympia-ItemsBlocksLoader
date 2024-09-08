<?php

namespace Olympia\items\hikabrain;

use customiesdevs\customies\item\component\BlockPlacerComponent;
use customiesdevs\customies\item\component\CanDestroyInCreativeComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;

class SwordAndBlock extends Sword implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name, ToolTier::IRON());
        $this->initComponent("iron_sword");
        $this->addComponent(new HandEquippedComponent(true));
        $this->addComponent(new CanDestroyInCreativeComponent(false));
        $this->addComponent(new BlockPlacerComponent("minecraft:sandstone"));
    }

    public function getMaxStackSize(): int
    {
        return 64;
    }

    public function pop(int $count = 1): Item
    {
        if($count === 1) return $this;
        if($count === -1) $count = 1;
        return parent::pop($count);
    }

    public function getBlock(?int $clickedFace = null): Block
    {
        return VanillaBlocks::SANDSTONE();
    }
}