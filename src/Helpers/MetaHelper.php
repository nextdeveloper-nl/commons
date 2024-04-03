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
     * @param string $objectType The type of the object.
     * @param int $objectId The ID of the object.
     * @param string $key The key of the metadata.
     * @return Meta|null The metadata object if found, null otherwise.
     */
    public static function get(string $objectType, int $objectId, string $key): ?Meta
    {
        return Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('key', $key)
            ->first();
    }

    /**
     * Set a metadata key-value pair for a specific object.
     * If the metadata already exists, it will be updated with the new value.
     *
     * @param string $objectType The type of the object.
     * @param int $objectId The ID of the object.
     * @param string $key The key of the metadata.
     * @param array $value The value of the metadata as an array.
     */
    public static function set(string $objectType, int $objectId, string $key, array $value)
    {
        $model = Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('key', $key)
            ->first();

        if ($model) {
            self::update($objectType, $objectId, $key, $value);
        } else {
            $model = Meta::create([
                'object_type' => $objectType,
                'object_id' => $objectId,
                'key' => $key,
                'value' => $value
            ]);
        }

        Events::fire("created:NextDeveloper\Commons\Meta", $model);
    }

    /**
     * Update the value of a metadata key associated with an object.
     *
     * @param string $objectType The type of the object.
     * @param int $objectId The ID of the object.
     * @param string $key The key of the metadata.
     * @param array $value The new value of the metadata as an array.
     */
    public static function update(string $objectType, int $objectId, string $key, array $value)
    {
        $model = Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('key', $key)
            ->first();

        if ($model) {
            $model->update(['value' => $value]);

            Events::fire("updated:NextDeveloper\Commons\Meta", $model);
        }
    }


    /**
     * Delete a specific metadata key associated with an object.
     *
     * @param string $objectType The type of the object.
     * @param int $objectId The ID of the object.
     * @param string $key The key of the metadata to delete.
     * @return void
     */
    public static function delete(string $objectType, int $objectId, string $key): void
    {
        $model = Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('key', $key)
            ->first();

        if ($model) {
            $model->delete();

            Events::fire("deleted:NextDeveloper\Commons\Meta", $model);
        }

    }

}
