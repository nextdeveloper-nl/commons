<?php

namespace NextDeveloper\Commons\Http\Traits;

use NextDeveloper\Commons\Database\Models\ViewTags;
use NextDeveloper\Commons\Http\Requests\Meta\MetaCreateRequest;
use NextDeveloper\Commons\Http\Requests\Tags\TagsAttachRequest;
use NextDeveloper\Commons\Services\TaggablesService;
use NextDeveloper\Commons\Services\TagsService;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use Psy\Util\Str;

trait Meta
{
    /**
     * Get tags of the related object
     *
     * @param $objectId
     * @return mixed|null
     */
    public function meta($objectId) {
        $obj = app($this->model)->where('uuid', $objectId)->first();

        $tags = \NextDeveloper\Commons\Database\Models\Meta::where([
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
    public function saveMeta($objectId, MetaCreateRequest $request) {
        $validRequest = $request->validated();

        $meta = \NextDeveloper\Commons\Database\Models\Meta::where([
            'object_type'   =>  $this->model,
            'object_id'     =>  $objectId,
            'key'           =>  $validRequest['key']
        ])->first();

        if($meta) {
            $meta->update([
                'value' =>  $validRequest['value']
            ]);
        } else {
            \NextDeveloper\Commons\Database\Models\Meta::create([
                'object_type'   =>  $this->model,
                'object_id'     =>  $objectId,
                'key'           =>  $validRequest['key'],
                'value' =>  $validRequest['value']
            ]);
        }

        return self::meta($objectId);
    }
}
