<?php

namespace NextDeveloper\Commons\Http\Traits;

use NextDeveloper\Commons\Database\Filters\AddressesQueryFilter;
use NextDeveloper\Commons\Exceptions\ModelNotFoundException;
use NextDeveloper\Commons\Http\Requests\Addresses\AddressesCreateRequest;
use NextDeveloper\Commons\Http\Requests\Tags\TagsAttachRequest;
use NextDeveloper\Commons\Services\AddressesService;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;

trait Addresses
{
    /**
     * Get tags of the related object
     *
     * @param $objectId
     * @return mixed|null
     */
    public function addresses($objectId) {
        $obj = app($this->model)->where('uuid', $objectId)->first();

        if(!$obj)
            throw new ModelNotFoundException('Cannot find the object that you wanted to add address for. This is '
                . 'most probably because of the wrong id of the object.');

        $tags = \NextDeveloper\Commons\Database\Models\Addresses::where([
            'object_type'   =>  $this->model,
            'object_id'     =>  $obj->id
        ])->get();

        return ResponsableFactory::makeResponse($this, $tags);
    }

    /**
     * This function attach tags directly to the object
     *
     * @param $objectId
     * @param TagsAttachRequest $request
     * @return void
     */
    public function saveAddresses($objectId, AddressesCreateRequest $request) {
        $validRequest = $request->validated();

        $obj = app($this->model)->where('uuid', $objectId)->first();

        if(!$obj)
            throw new ModelNotFoundException('Cannot find the object that you wanted to add address for. This is '
                . 'most probably because of the wrong id of the object.');

        $data = $request->validated();

        $address = \NextDeveloper\Commons\Database\Models\Addresses::where('name', $data['name'])->first();

        if($address)
            return self::addresses($objectId);

        //  Exploding tags here to understand which tags should be attached
        AddressesService::create(array_merge([
            'object_type'   =>  $this->model,
            'object_id'     =>  $obj->id,
        ],$data));

        return self::addresses($objectId);
    }
}
