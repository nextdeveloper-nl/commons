<?php

namespace NextDeveloper\Commons\Http\Traits;

use NextDeveloper\Commons\Http\Requests\Tags\TagsAttachRequest;
use NextDeveloper\Commons\Http\Response\ResponsableFactory;
use NextDeveloper\Commons\Services\TaggablesService;

trait Tags
{
    /**
     * Get tags of the related object
     *
     * @param $objectId
     * @return mixed|null
     */
    public function tags($objectId) {
        $obj = app($this->model)->where('uuid', $objectId)->first()->toArray();

        if(!in_array('tags', array_keys($obj))) {
            $obj['tags'] = [];
        }

        return ResponsableFactory::makeResponse($this, $obj['tags']);
    }

    /**
     * This function attach tags directly to the object
     *
     * @param $objectId
     * @param TagsAttachRequest $request
     * @return void
     */
    public function tag($objectId, TagsAttachRequest $request) {
        $validRequest = $request->validated();
        $tags = $validRequest['tags'];

        //  Exploding tags here to understand which tags should be attached
        $tags = explode(',', $tags);

        foreach ($tags as $tag) {
            $tag = trim($tag);
            TaggablesService::createWithTag([
                'object_type'   =>  $this->model,
                'object_id'     =>  $objectId,
                'tag'           =>  $tag
            ]);
        }

        return self::tags($objectId);
    }
}
