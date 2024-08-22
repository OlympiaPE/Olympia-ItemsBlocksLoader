<?php

namespace Olympia\items\tools\swords\types;

use customiesdevs\customies\item\component\IconComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use Olympia\Kitmap\items\tools\swords\DashSword;
use Olympia\Kitmap\managers\Managers;
use Olympia\Kitmap\utils\constants\GlobalConstants;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\ItemIdentifier;
use pocketmine\nbt\tag\CompoundTag;

final class InfinitySword extends DashSword
{
    private const TAG_SWORD_LEVEL = "SwordLevel";
    private const TAG_SWORD_KILLS = "SwordKills";

    private array $killsRequiredOnLevels = [
        1 => 0,
        2 => 10,
        3 => 25,
        4 => 50,
        5 => 100
    ];

    private int $level = 1;
    private int $kills = 0;

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);

        $creativeInfo = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_SWORD);
        $this->initComponent("infinity_sword", $creativeInfo);

        $this->setCustomName("§r§tEpée de l'infini");
        $this->addComponent(new IconComponent("infinity_sword"));

        $this->setUnbreakable();

        $this->updateSwordEnchantment();
        $this->updateLore();
    }

    public function getMaxDurability(): int
    {
        return GlobalConstants::ITEM_MAX_DURABILITY;
    }

    public function getAttackPoints(): int
    {
        return Managers::CONFIG()->getNested("items-stats.orichalque_sword.damage");
    }

    public function keepOnDeath(): bool
    {
        return true;
    }

    protected function deserializeCompoundTag(CompoundTag $tag): void
    {
        parent::deserializeCompoundTag($tag);
        $this->setSwordLevel($tag->getInt(self::TAG_SWORD_LEVEL, $this->getSwordLevel()));
        $this->setSwordKills($tag->getInt(self::TAG_SWORD_KILLS, $this->getSwordKills()));

        $this->updateSwordEnchantment();
        $this->updateLore();
    }

    protected function serializeCompoundTag(CompoundTag $tag): void
    {
        parent::serializeCompoundTag($tag);
        $tag->setInt(self::TAG_SWORD_LEVEL, $this->getSwordLevel());
        $tag->setInt(self::TAG_SWORD_KILLS, $this->getSwordKills());
    }

    public function updateLore(): void
    {
        $this->setLore([
            "§r",
            "§r§fNiveau: §e{$this->getSwordLevel()}",
            "§r§fNombre de kill(s): §e{$this->getSwordKills()}" . ($this->isSwordLevelMaxed() ? "" : "/{$this->getKillsRequiredOnNextLevel()}"),
        ]);
    }

    public function getSwordLevel(): int
    {
        return $this->level;
    }

    public function isSwordLevelMaxed(): bool
    {
        return $this->level >= 5;
    }

    public function increaseSwordLevel(): void
    {
        $this->level++;
    }

    private function setSwordLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getSwordKills(): int
    {
        return $this->kills;
    }


    public function addSwordKills(): void
    {
        $this->kills++;
    }

    private function setSwordKills(int $kills): void
    {
        $this->kills = $kills;
    }

    public function getKillsRequiredOnLevels(): array
    {
        return $this->killsRequiredOnLevels;
    }

    public function getKillsRequiredOnNextLevel(): int
    {
        return $this->isSwordLevelMaxed() ? $this->getKillsRequiredOnLevels()[5] : $this->getKillsRequiredOnLevels()[$this->getSwordLevel() + 1];
    }

    public function needIncreaseLevel(): bool
    {
        return !$this->isSwordLevelMaxed() && $this->getKillsRequiredOnNextLevel() <= $this->getSwordKills();
    }

    public function updateSwordEnchantment(): void
    {
        if (!$this->hasEnchantment(VanillaEnchantments::SHARPNESS())) {
            $this->addSwordEnchantmentForCurrentLevel();
        }
    }

    public function addSwordEnchantmentForCurrentLevel(): void
    {
        $this->addEnchantment(new EnchantmentInstance(VanillaEnchantments::SHARPNESS(), $this->getSwordLevel()));
    }
}