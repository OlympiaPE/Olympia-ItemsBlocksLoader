<?php

namespace Olympia\items\tools\pickaxes\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\items\tools\pickaxes\SimplePickaxe;
use pocketmine\block\Block;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;
use pocketmine\nbt\tag\CompoundTag;

final class VulcainPickaxe extends SimplePickaxe
{
    private const TAG_PICKAXE_LEVEL = "PickaxeLevel";
    private const TAG_PICKAXE_BLOCKS = "PickaxeBlocks";

    private array $blocksRequiredOnLevels = [
        1 => 0,
        2 => 200,
        3 => 500,
        4 => 1000,
        5 => 2500
    ];

    private int $level = 1;
    private int $blocks = 0;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name, ToolTier::NETHERITE);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_PICKAXE);
        $this->initComponent("vulcain_pickaxe", $creativeInfo);

        $this->setCustomName("§r§tPioche de Vulcain");
        $this->addComponent(new IconComponent("vulcain_pickaxe"));

        $this->setUnbreakable();

        $this->updatePickaxeEnchantment();
        $this->updateLore();
    }

    public function keepOnDeath(): bool
    {
        return true;
    }

    protected function deserializeCompoundTag(CompoundTag $tag): void
    {
        parent::deserializeCompoundTag($tag);
        $this->setPickaxeLevel($tag->getInt(self::TAG_PICKAXE_LEVEL, $this->getPickaxeLevel()));
        $this->setPickaxeBlocks($tag->getInt(self::TAG_PICKAXE_BLOCKS, $this->getPickaxeBlocks()));

        $this->updatePickaxeEnchantment();
        $this->updateLore();
    }

    protected function serializeCompoundTag(CompoundTag $tag): void
    {
        parent::serializeCompoundTag($tag);
        $tag->setInt(self::TAG_PICKAXE_LEVEL, $this->getPickaxeLevel());
        $tag->setInt(self::TAG_PICKAXE_BLOCKS, $this->getPickaxeBlocks());
    }

    public function onDestroyBlock(Block $block, array &$returnedItems): bool
    {
        $this->addPickaxeBlocks();
        if ($this->needIncreaseLevel()) {
            $this->increasePickaxeLevel();
            $this->updatePickaxeEnchantment();
        }
        $this->updateLore();
        return parent::onDestroyBlock($block, $returnedItems);
    }

    public function updateLore(): void
    {
        $this->setLore([
            "§r",
            "§r§fNiveau: §e{$this->getPickaxeLevel()}",
            "§r§fBlock(s) miné(s): §e{$this->getPickaxeBlocks()}" . ($this->isPickaxeLevelMaxed() ? "" : "/{$this->getBlocksRequiredOnNextLevel()}"),
        ]);
    }

    public function getPickaxeLevel(): int
    {
        return $this->level;
    }

    public function isPickaxeLevelMaxed(): bool
    {
        return $this->level >= 5;
    }

    public function increasePickaxeLevel(): void
    {
        $this->level++;
    }

    private function setPickaxeLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getPickaxeBlocks(): int
    {
        return $this->blocks;
    }


    public function addPickaxeBlocks(): void
    {
        $this->blocks++;
    }

    private function setPickaxeBlocks(int $kills): void
    {
        $this->blocks = $kills;
    }

    public function getBlocksRequiredOnLevels(): array
    {
        return $this->blocksRequiredOnLevels;
    }

    public function getBlocksRequiredOnNextLevel(): int
    {
        return $this->isPickaxeLevelMaxed() ? $this->getBlocksRequiredOnLevels()[5] : $this->getBlocksRequiredOnLevels()[$this->getPickaxeLevel() + 1];
    }

    public function needIncreaseLevel(): bool
    {
        return !$this->isPickaxeLevelMaxed() && $this->getBlocksRequiredOnNextLevel() <= $this->getPickaxeBlocks();
    }

    public function getEfficiencyEnchantmentLevelForCurrentLevel(): int
    {
        return match ($this->getPickaxeLevel()) {
            1 => 2,
            2 => 3,
            3 => 4,
            4, 5 => 5,
        };
    }

    public function updatePickaxeEnchantment(): void
    {
        if (!$this->hasEnchantment(VanillaEnchantments::EFFICIENCY()) || $this->getEnchantmentLevel(VanillaEnchantments::EFFICIENCY())) {
            $this->addEnchantment(new EnchantmentInstance(VanillaEnchantments::EFFICIENCY(), $this->getEfficiencyEnchantmentLevelForCurrentLevel()));
        }
    }
}