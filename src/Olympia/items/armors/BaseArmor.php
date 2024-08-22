<?php

namespace Olympia\items\armors;

use customiesdevs\customies\item\component\ArmorComponent;
use customiesdevs\customies\item\component\CanDestroyInCreativeComponent;
use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\component\UseAnimationComponent;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\ItemIdentifier;

abstract class BaseArmor extends Armor implements ItemComponents
{
    use ItemComponentsTrait;

    private const ARMOR_WEARABLE = [
        0 => 'slot.armor.head',
        1 => 'slot.armor.chest',
        2 => 'slot.armor.legs',
        3 => 'slot.armor.feet'
    ];

    public function __construct(ItemIdentifier $identifier, string $name, ArmorTypeInfo $info)
    {
        parent::__construct($identifier, $name, $info);

        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new ArmorComponent($this->getDefensePoints(), "diamond"));
        $this->addComponent(new CanDestroyInCreativeComponent(true));
        $this->addComponent(new UseAnimationComponent(0));
    }

    public function addEnchantment(EnchantmentInstance $enchantment): self
    {
        $this->setCustomName(str_replace("§f", "§b", $this->getCustomName()));
        return parent::addEnchantment($enchantment);
    }
}