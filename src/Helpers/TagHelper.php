<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\Tags;
use NextDeveloper\Commons\Services\TagsService;

class TagHelper
{
    private $_taggableObjects = [];

    public function __construct($taggables = [])
    {
        $this->_taggableObjects = array_merge(
            $taggables,
            config('commons.taggable_objects')
        );
    }

    public function getObject($object) : ?string {
        if(array_key_exists(strtolower($object), $this->_taggableObjects)) {
            return $this->_taggableObjects[strtolower($object)];
        }

        return null;
    }

    public function getAlias($object) : ?string {
        $object = str_replace('\\\\', '\\', $object);
        foreach ($this->_taggableObjects as $alias => $taggables) {
            if($taggables == $object)
                return $alias;
        }
    }

    public function getTag($tag) : Tags {
        $obj = TagsService::getOrCreate($tag);

        return $obj;
    }
}
