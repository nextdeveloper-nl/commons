<?php

namespace NextDeveloper\Commons\Helpers;

use NextDeveloper\Commons\Database\Models\Meta;
use NextDeveloper\Events\Services\Events;

/**
 * Class MetaHelper
 *
 * A helper class for managing metadata associated with different objects.
 */
class MetaHelper
{

    /**
     * Get all metadata associated with a specific object.
     *
     * @param string $objectType The type of the object.
     * @param int $objectId The ID of the object.
     * @return Meta[] An array containing all metadata objects.
     */
    public static function getAll(string $objectType, int $objectId): array
    {
        $models = Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->get();

        return $models->all();
    }


    /**
     * Get the value of a specific metadata key associated with an object.
     *
     * @param $object
     * @param string $key The key of the metadata.
     * @param null $defaultValue
     * @return Meta|null The metadata object if found, null otherwise.
     */
    public static function get($object, string $key, $defaultValue = null): mixed
    {
        $meta = Meta::withoutGlobalScopes()
            ->where('object_type', get_class($object))
            ->where('object_id', $object->id)
            ->where('key', $key)
            ->first();

        if($meta)
            return $meta->value;

        if(!is_null($defaultValue)) {
            $meta = self::set($object, $key, $defaultValue);

            return $meta->value;
        }

        return null;
    }

    /**
     * Set a metadata key-value pair for a specific object.
     * If the metadata already exists, it will be updated with the new value.
     *
     * @param $object
     * @param string $key The key of the metadata.
     * @param array $value The value of the metadata as an array.
     * @return Meta
     */
    public static function set($object, string $key, $value): Meta
    {
        $meta = Meta::withoutGlobalScopes()
            ->where('object_type', get_class($object))
            ->where('object_id', $object->id)
            ->where('key', $key)
            ->first();

        if ($meta) {
            self::update($object, $key, $value);
        } else {
            $model = Meta::create([
                'object_type' => get_class($object),
                'object_id' => $object->id,
                'key' => $key,
                'value' => $value
            ]);
        }

        Events::fire("created:NextDeveloper\Commons\Meta", $model);

        return $model;
    }

    /**
     * Update the value of a metadata key associated with an object.
     *
     * @param $object
     * @param string $key The key of the metadata.
     * @param array $value The new value of the metadata as an array.
     */
    public static function update($object, string $key, array $value): void
    {
        $meta = Meta::withoutGlobalScopes()
            ->where('object_type', get_class($object))
            ->where('object_id', $object->id)
            ->where('key', $key)
            ->first();

        if ($meta) {
            $meta->update(['value' => $value]);

            Events::fire("updated:NextDeveloper\Commons\Meta", $meta);
        }
    }


    /**
     * Delete a specific metadata key associated with an object.
     *
     * @param $object
     * @param string $key The key of the metadata to delete.
     * @return void
     */
    public static function delete($object, string $key): void
    {
        $meta = Meta::withoutGlobalScopes()
            ->where('object_type', get_class($object))
            ->where('object_id', $object->id)
            ->where('key', $key)
            ->first();


        if ($meta) {
            $meta->delete();

            Events::fire("deleted:NextDeveloper\Commons\Meta", $meta);
        }

    }

}
