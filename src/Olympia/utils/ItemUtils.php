<?php

/** @noinspection PhpExpressionResultUnusedInspection */

namespace Olympia\utils;

use Closure;
use InvalidArgumentException;
use ReflectionException;
use Olympia\utils\reflection\ReflectionUtils;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\item\StringToItemParser;
use pocketmine\world\format\io\GlobalItemDataHandlers;
use pocketmine\data\bedrock\item\SavedItemData;
use pocketmine\inventory\CreativeInventory;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\protocol\serializer\ItemTypeDictionary;

abstract class ItemUtils
{
    /**
     * Allows you to clone an item without deleting the original one
     * So this turns into two totally different items on pocketmine, but on the customer side it's exactly the same.
     *
     * @param Item $item
     * @param string $itemStringId
     * @param string $cloneIdentifier
     * @return void
     * @throws ReflectionException
     */
    public static function clone(Item $item, string $itemStringId, string $cloneIdentifier): void
    {
        $itemTypeDictionary = TypeConverter::getInstance()->getItemTypeDictionary();
        $currentItemId = $itemTypeDictionary->fromStringId($itemStringId);

        $value = ReflectionUtils::getProperty(ItemTypeDictionary::class, $itemTypeDictionary, "intToStringIdMap");
        ReflectionUtils::setProperty(ItemTypeDictionary::class, $itemTypeDictionary, "intToStringIdMap", $value + [$currentItemId => $cloneIdentifier]);
        $value = ReflectionUtils::getProperty(ItemTypeDictionary::class, $itemTypeDictionary, "stringToIntMap");
        ReflectionUtils::setProperty(ItemTypeDictionary::class, $itemTypeDictionary, "stringToIntMap", $value + [$cloneIdentifier => $currentItemId]);
        StringToItemParser::getInstance()->register($cloneIdentifier, fn() => clone $item);
        GlobalItemDataHandlers::getDeserializer()->map($cloneIdentifier, fn() => clone $item);
        GlobalItemDataHandlers::getSerializer()->map($item, fn() => new SavedItemData($cloneIdentifier));
        CreativeInventory::getInstance()->add(clone $item);
    }

    public static function registerSerializerAndDeserializerItem(Item $item, string $id, Closure $serializer, Closure $deserializer): void
    {
        self::registerSerializerItem($item, $serializer);
        self::registerDeserializerItem($id, $deserializer);
        self::overrideVanillaItem($id, $item);
    }

    public static function registerSerializerItem(Item $item, Closure $serializer): void
    {
        $instance = GlobalItemDataHandlers::getSerializer();
        try {
            $instance->map($item, $serializer);
        } catch (InvalidArgumentException) {
            $serializerProperty = new \ReflectionProperty($instance, "itemSerializers");
            $serializerProperty->setAccessible(true);
            $value = $serializerProperty->getValue($instance);
            $value[$item->getTypeId()] = $serializer;
            $serializerProperty->setValue($instance, $value);
        }

    }

    public static function registerDeserializerItem(string $id, Closure $deserializer): void
    {
        $instance = GlobalItemDataHandlers::getDeserializer();
        try {
            $instance->map($id, $deserializer);
        } catch (InvalidArgumentException) {
            $deserializerProperty = new \ReflectionProperty($instance, "deserializers");
            $deserializerProperty->setAccessible(true);
            $value = $deserializerProperty->getValue($instance);
            $value[$id] = $deserializer;
            $deserializerProperty->setValue($instance, $value);
        }
    }

    public static function registerSerializerAndDeserializerItemBlock(ItemBlock $itemBlock, string $id, Closure $serializer, Closure $deserializer): void
    {
        self::registerSerializerItemBlock($itemBlock, $serializer);
        self::registerDeserializerItem($id, $deserializer);
    }

    public static function registerSerializerItemBlock(ItemBlock $itemBlock, Closure $serializer): void
    {
        $instance = GlobalItemDataHandlers::getSerializer();
        try {
            $instance->mapBlock($itemBlock, $serializer);
        } catch (InvalidArgumentException) {
            $serializerProperty = new \ReflectionProperty($instance, "blockItemSerializers");
            $serializerProperty->setAccessible(true);
            $value = $serializerProperty->getValue($instance);
            $value[$itemBlock->getTypeId()] = $serializer;
            $serializerProperty->setValue($instance, $value);
        }
    }

    private static function overrideVanillaItem(string $id, Item $item): void
    {
        StringToItemParser::getInstance()->override(explode(':', $id)[1], fn() => $item);
    }

    public function getItemSerializer(int $typeId): ?callable
    {
        $instance = GlobalItemDataHandlers::getSerializer();
        $serializerProperty = new \ReflectionProperty($instance, "itemSerializers");
        $serializerProperty->setAccessible(true);
        $value = $serializerProperty->getValue($instance);
        return $value[$typeId] ?? null;
    }

    public function getItemDeserializer(string $id): ?callable
    {
        $instance = GlobalItemDataHandlers::getDeserializer();
        $serializerProperty = new \ReflectionProperty($instance, "deserializers");
        $serializerProperty->setAccessible(true);
        $value = $serializerProperty->getValue($instance);
        return $value[$id] ?? null;
    }
}