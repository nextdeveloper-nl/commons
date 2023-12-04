<?php

namespace NextDeveloper\Commons\Http\Traits;

use NextDeveloper\Commons\Database\Models\ViewTags;
use NextDeveloper\Commons\Http\Requests\Tags\TagsAttachRequest;
use NextDeveloper\Commons\Services\TaggablesService;
use NextDeveloper\Commons\Services\TagsService;
use NextDeveloper\Generator\Http\Traits\ResponsableFactory;
use Psy\Util\Str;

trait Tags
{
    /**
     * Get tags of the related object
     *
     * @param $objectId
     * @return mixed|null
     */
    public function tags($objectId) {
        $obj = app($this->model)->where('uuid', $objectId)->first();

        $tags = ViewTags::where([
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
    public function saveTags($objectId, TagsAttachRequest $request) {
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
