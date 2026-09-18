<?php

namespace NextDeveloper\Commons\Http\Traits;

use NextDeveloper\Commons\Helpers\DatabaseHelper;
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
        $obj = app($this->model)->where('uuid', $objectId)->first();

        if(!$obj) {
            return $this->errorNotFound('Cannot find the object you are asking the tags of.');
        }

        $obj = $obj->toArray();

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

    /**
     * Adds tags (comma separated) to the object, keeping the ones it has, and returns them all.
     *
     * The routes of every generated module point here. The tags go to the object's own tags column,
     * which is what tags() reads and what the object's payload carries; an object without that
     * column is tagged through common_taggables instead (tag()).
     *
     * @param $objectId
     * @param TagsAttachRequest $request
     * @return mixed
     */
    public function saveTags($objectId, TagsAttachRequest $request) {
        $object = app($this->model)->where('uuid', $objectId)->first();

        if(!$object) {
            return $this->errorNotFound('Cannot find the object you want to tag.');
        }

        if(!DatabaseHelper::isColumnExists($object->getTable(), 'tags')) {
            return $this->tag($objectId, $request);
        }

        $tags = array_values(array_unique(array_merge(
            (array) ($object->tags ?? []),
            array_filter(array_map('trim', explode(',', $request->validated('tags'))), 'strlen')
        )));

        $object->update(['tags' => $tags]);

        return ResponsableFactory::makeResponse($this, $object->fresh()->tags ?? []);
    }
}
