<?php

namespace Olympia\items\tools\sickles;

use customiesdevs\customies\item\component\DurabilityComponent;
use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use Olympia\Kitmap\items\properties\DamageComponent;
use pocketmine\block\Air;
use pocketmine\block\Beetroot;
use pocketmine\block\Block;
use pocketmine\block\Carrot;
use pocketmine\block\Crops;
use pocketmine\block\Dirt;
use pocketmine\block\Farmland;
use pocketmine\block\Grass;
use pocketmine\block\Potato;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Wheat;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\item\TieredTool;
use pocketmine\item\ToolTier;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\BlockBreakSound;
use pocketmine\world\sound\BlockPlaceSound;

abstract class BaseSickle extends TieredTool implements ItemComponents
{
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name, ToolTier::DIAMOND);

        $this->addComponent(new MaxStackSizeComponent(1));
        $this->addComponent(new HandEquippedComponent(true));
        $this->addComponent(new DurabilityComponent($this->getMaxDurability()));
        $this->addComponent(new DamageComponent($this->getAttackPoints()));
    }

    public function addEnchantment(EnchantmentInstance $enchantment): self
    {
        $this->setCustomName(str_replace("§f", "§b", $this->getCustomName()));
        return parent::addEnchantment($enchantment);
    }

    abstract public function getRadius(): int;

    /**
     * @return array<Carrot|Potato|Wheat|Beetroot>
     */
    public function getSeeds(): array
    {
        return [
            ItemTypeIds::CARROT => VanillaBlocks::CARROTS(),
            ItemTypeIds::POTATO => VanillaBlocks::POTATOES(),
            ItemTypeIds::WHEAT_SEEDS => VanillaBlocks::WHEAT(),
            ItemTypeIds::BEETROOT_SEEDS => VanillaBlocks::BEETROOTS(),
        ];
    }

    public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult
    {
        $world = $blockClicked->getPosition()->getWorld();
        $centerPos = $blockClicked->getPosition()->floor();
        $radius = floor($this->getRadius() / 2);

        $playSoundSeed = false;
        $playSoundFarmland = false;
        $damage = 0;

        $playerInventory = $player->getInventory();

        for ($x = $centerPos->getX() - $radius; $x <= $centerPos->getX() + $radius; $x++) {
            for ($z = $centerPos->getZ() - $radius; $z <= $centerPos->getZ() + $radius; $z++) {
                $blockPos = new Vector3($x, $centerPos->y, $z);
                $block = $world->getBlock($blockPos);
                if ($block instanceof Dirt || $block instanceof Grass) {
                    $world->setBlock($blockPos, VanillaBlocks::FARMLAND());
                    $playSoundFarmland = true;
                    $damage++;
                }elseif ($block instanceof Farmland) {
                    $seedPos = $blockPos->add(0, 1, 0);
                    $seedBlock = $world->getBlock($seedPos);
                    if ($seedBlock instanceof Air) {
                        foreach ($playerInventory->getContents() as $slot => $item) {
                            if (array_key_exists($item->getTypeId(), $this->getSeeds())) {
                                $world->setBlock($seedPos, $item->getBlock());
                                $playerInventory->setItem($slot, $item->setCount($item->getCount() - 1));
                                $playSoundSeed = true;
                                $damage++;
                                break;
                            }
                        }
                    }
                }
            }
        }

        if ($playSoundSeed) {
            $player->broadcastSound(new BlockPlaceSound(VanillaBlocks::GRASS()));
        }

        if ($playSoundFarmland) {
            $player->broadcastSound(new BlockPlaceSound(VanillaBlocks::FARMLAND()));
        }

        if ($damage > 0) {
            $this->applyDamage($damage);
        }

        return ItemUseResult::SUCCESS;
    }

    public function onDestroyBlock(Block $block, array &$returnedItems): bool
    {
        $world = $block->getPosition()->getWorld();
        $centerPos = $block->getPosition()->floor();
        $radius = floor($this->getRadius() / 2);

        $playSoundSeed = false;
        $damage = 0;

        for ($x = $centerPos->getX() - $radius; $x <= $centerPos->getX() + $radius; $x++) {
            for ($z = $centerPos->getZ() - $radius; $z <= $centerPos->getZ() + $radius; $z++) {
                $blockPos = new Vector3($x, $centerPos->y, $z);
                $block = $world->getBlock($blockPos);
                foreach ($this->getSeeds() as $seedBlock) {
                    /** @var Carrot|Potato|Wheat|Beetroot $block */
                    if ($block instanceof $seedBlock) {
                        if ($block->getAge() === Crops::MAX_AGE) {
                            foreach ($block->getDrops($this) as $drop) {
                                $returnedItems[] = $drop;
                            }
                            $world->setBlock($blockPos, VanillaBlocks::AIR());
                            $playSoundSeed = true;
                            $damage++;
                        }
                        break;
                    }
                }
            }
        }

        if ($playSoundSeed) {
            $world->addSound($centerPos, new BlockBreakSound(VanillaBlocks::GRASS()));
        }

        if ($damage > 0) {
            $this->applyDamage($damage);
        }

        return true;
    }
}