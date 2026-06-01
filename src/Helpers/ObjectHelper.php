<?php

namespace NextDeveloper\Commons\Helpers;

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
}
