<?php

namespace Olympia\items\tools\swords;

use customiesdevs\customies\item\component\CanDestroyInCreativeComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\items\properties\DamageComponent;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;

abstract class BaseSword extends Sword implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name, ToolTier::DIAMOND());

        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new CanDestroyInCreativeComponent(true));
        $this->addComponent(new HandEquippedComponent(true));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));
    }
}