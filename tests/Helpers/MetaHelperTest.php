<?php

namespace Tests\Helpers;

use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\Meta;
use NextDeveloper\Commons\Helpers\MetaHelper;
use Tests\TestCase;

class MetaHelperTest extends TestCase
{


    /** @test */
    public function test_it_can_get_all_metadata_associated_with_an_object()
    {
        $objectType = 'NextDeveloper\IAAS\Database\VirtualMachines';
        $objectId = 123456;

        $metaCount = count(MetaHelper::getAll($objectType, $objectId));

        Meta::create([
            'object_type' => $objectType,
            'object_id' => $objectId,
            'key' => Str::random(6),
            'value' => ['foo' => 'bar'],
        ]);

        Meta::create([
            'object_type' => $objectType,
            'object_id' => $objectId,
            'key' => Str::random(6),
            'value' => ['baz' => 'qux'],
        ]);

        Meta::create([
            'object_type' => $objectType,
            'object_id' => $objectId,
            'key' => Str::random(6),
            'value' => ['quux' => 'corge'],
        ]);

        $metadata = MetaHelper::getAll($objectType, $objectId);

        $this->assertCount($metaCount + 3, $metadata);
    }

    /** @test */
    public function test_it_can_get_a_specific_metadata_key_associated_with_an_object()
    {
        $objectType = 'NextDeveloper\IAAS\Database\VirtualMachines';
        $objectId = 123456;
        $key = Str::random(6);
        $value = ['foo' => 'bar'];

        Meta::create([
            'object_type' => $objectType,
            'object_id' => $objectId,
            'key' => $key,
            'value' => $value,
        ]);

        $metadata = MetaHelper::get($objectType, $objectId, $key);

        $this->assertEquals($value, $metadata->value);
    }

    /** @test */
    public function test_it_can_set_a_metadata_key_value_pair_for_an_object()
    {
        $objectType = 'NextDeveloper\IAAS\Database\VirtualMachines';
        $objectId = 123456;
        $key = Str::random(6);
        $value = ['foo' => 'bar'];

        MetaHelper::set($objectType, $objectId, $key, $value);

        $metadata = Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('key', $key)
            ->first();

        $this->assertEquals($value, $metadata->value);
    }

    /** @test */
    public function test_it_can_update_the_value_of_a_metadata_key_associated_with_an_object()
    {
        $objectType = 'NextDeveloper\IAAS\Database\VirtualMachines';
        $objectId = 123456;
        $key = Str::random(6);
        $originalValue = ['foo' => 'bar'];
        $newValue = ['baz' => 'qux'];

        Meta::create([
            'object_type' => $objectType,
            'object_id' => $objectId,
            'key' => $key,
            'value' => $originalValue,
        ]);

        MetaHelper::update($objectType, $objectId, $key, $newValue);

        $updatedMetadata = Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('key', $key)
            ->first();

        $this->assertEquals($newValue, $updatedMetadata->value);
    }

    /** @test */
    public function test_it_can_delete_a_specific_metadata_key_associated_with_an_object()
    {
        $objectType = 'NextDeveloper\IAAS\Database\VirtualMachines';
        $objectId = 123456;
        $key = Str::random(6);
        $value = ['foo' => 'bar'];

        Meta::create([
            'object_type' => $objectType,
            'object_id' => $objectId,
            'key' => $key,
            'value' => $value,
        ]);

        MetaHelper::delete($objectType, $objectId, $key);

        $deletedMetadata = Meta::withoutGlobalScopes()
            ->where('object_type', $objectType)
            ->where('object_id', $objectId)
            ->where('key', $key)
            ->first();

        $this->assertNull($deletedMetadata);
    }
}
