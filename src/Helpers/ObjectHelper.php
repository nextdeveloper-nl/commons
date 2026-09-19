<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ObjectHelper
{
    public static function getObject($objectType, $objectId)
    {
        $isUuid = Str::isUuid($objectId);

        $explodedClass = explode('\\', $objectType);
        if (count($explodedClass) == 3) {
            $objectType = self::getPrivateObjectName($objectType);
        }

        if (!class_exists($objectType)) {
            return null;
        }

        $object = new $objectType();

        if ($isUuid) {
            $object = $object->where('uuid', $objectId)->first();
        } else {
            $object = $object->where('id', $objectId)->first();
        }

        if ($object) {
            return $object;
        }

        return null;
    }

    // Converts a full model class (e.g. NextDeveloper\IAAS\Database\Models\VirtualMachines)
    // to its public short form (e.g. NextDeveloper\IAAS\VirtualMachines)
    public static function getPublicObjectName($object): string
    {
        $class = is_string($object) ? $object : get_class($object);

        return Str::replace('\Database\Models', '', $class);
    }

    // Converts a public short form (e.g. NextDeveloper\IAAS\VirtualMachines)
    // to the full model class (e.g. \NextDeveloper\IAAS\Database\Models\VirtualMachines)
    public static function getPrivateObjectName(string $objectType): string
    {
        $parts = explode('\\', $objectType);

        if (count($parts) != 3) {
            throw new \Exception('The object type is not valid. It should be in format Vendor\Package\ModelName');
        }

        return '\\' . $parts[0] . '\\' . $parts[1] . '\Database\\Models\\' . $parts[2];
    }

    /**
     * The model class an object type names, given as the class
     * (NextDeveloper\Fixlean\Database\Models\StationCards), in its public form
     * (NextDeveloper\Fixlean\StationCards) or in its short form (Fixlean\StationCards). Null when
     * it names no NextDeveloper model, so a request cannot make this load or instantiate an
     * arbitrary class.
     */
    public static function getModelClass(?string $objectType): ?string
    {
        $objectType = ltrim(trim((string) $objectType), '\\');

        if (count(explode('\\', $objectType)) === 2) {
            $objectType = 'NextDeveloper\\' . $objectType;
        }

        if (!Str::startsWith($objectType, 'NextDeveloper\\')) {
            return null;
        }

        if (count(explode('\\', $objectType)) === 3) {
            $objectType = ltrim(self::getPrivateObjectName($objectType), '\\');
        }

        if (!class_exists($objectType) || !is_subclass_of($objectType, Model::class)) {
            return null;
        }

        return $objectType;
    }

    /**
     * The uuid of an object referenced as type + internal id, or null when it no longer exists.
     *
     * Read past the caller's scopes: the row that holds the reference is the one being authorized,
     * and a uuid discloses nothing an id did not.
     */
    public static function getObjectUuid(?string $objectType, $objectId): ?string
    {
        $class = self::getModelClass($objectType);

        if (!$class || $objectId === null || $objectId === '') {
            return null;
        }

        if (is_string($objectId) && Str::isUuid($objectId)) {
            return $objectId;
        }

        return $class::withoutGlobalScopes()->where('id', (int) $objectId)->value('uuid');
    }
}
