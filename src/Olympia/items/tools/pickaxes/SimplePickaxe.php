<?php

namespace Olympia\items\tools\pickaxes;

use customiesdevs\customies\item\component\CanDestroyInCreativeComponent;
use customiesdevs\customies\item\component\DiggerComponent;
use customiesdevs\customies\item\component\DisplayNameComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\blocks\BlockDigger;
use Olympia\items\properties\DamageComponent;
use pocketmine\item\enchantment\ItemEnchantmentTags;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Pickaxe;
use pocketmine\item\ToolTier;

abstract class SimplePickaxe extends Pickaxe implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name, ToolTier $tier)
    {
        parent::__construct($identifier, $name, $tier, [ItemEnchantmentTags::PICKAXE]);

        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new DisplayNameComponent($this->getCustomName()));
        $this->addComponent(new CanDestroyInCreativeComponent(false));
        $this->addComponent(new HandEquippedComponent(true));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));

        $diggerComponent = new DiggerComponent();
        $blocks = BlockDigger::getBlocksToolTypeById($this->getBlockToolType());
        $diggerComponent->withBlocks(12, ...$blocks);
        $this->addComponent($diggerComponent);
    }
}