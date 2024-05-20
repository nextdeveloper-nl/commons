<?php

namespace NextDeveloper\Commons\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use InvalidArgumentException;
use NextDeveloper\Commons\Database\Models\Tags;
use NextDeveloper\Commons\Exceptions\CannotCreateModelException;
use NextDeveloper\Commons\Exceptions\ModelNotFoundException;
use NextDeveloper\Commons\Services\TagsService;
use NextDeveloper\IAM\Database\Scopes\AuthorizationScope;

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

    /**
     * Clean and format the tags array
     *
     * @param array $tags
     * @return array
     */
    private static function cleanTags(array $tags): array
    {
        $cleanedTags = array_map(function ($tag) {
            return trim($tag, " \t\n\r\0\x0B\"");
        }, $tags);

        $uniqueTags = array_unique($cleanedTags);

        return array_filter($uniqueTags, function ($tag) {
            return !empty($tag);
        });
    }

    /**
     * Tag an object with a tag
     *
     * @param object $object
     * @param string $tag
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws ModelNotFoundException
     * @throws CannotCreateModelException
     */
    public static function tag(object $object, string $tag): void
    {

        // Get the tag object
        $tagObj = Tags::withoutGlobalScope(AuthorizationScope::class)
            ->where('name', 'like', $tag)
            ->first();

        // If the tag does not exist, create it
        if (!$tagObj) {
            $tagObj = TagsService::create([
                'name'        => $tag,
                'description' => '',
                'slug'        => Str::slug($tag),
            ]);
        }

        // If the tag object is still not found, throw an exception
        if (!$tagObj) {
            throw new CannotCreateModelException('Cannot create the tag you are looking for.');
        }

        // Get the tags of the object
        $objectTags = $object->tags;

        // If the tag is not already tagged, tag it
        if (!in_array($tagObj->name, $objectTags)) {
            $objectTags[] = $tagObj->name;
            $object->tags = self::cleanTags($objectTags);
            $object->save();
        }
    }

    /**
     * Untag an object with a tag
     *
     * @param object $object
     * @param string $tag
     * @return void
     * @throws InvalidArgumentException
     */
    public static function untag(object $object, string $tag): void
    {

        // Define the key as null
        $key = null;

        // Get the tags of the object
        $objectTags = self::cleanTags($object->tags);

        // Find the tag in the tags array
        $key  = array_search($tag, $objectTags);

        // If the tag is found, remove it
        if (is_int($key)) {
            unset($objectTags[$key]);
            $object->tags = self::cleanTags($objectTags);
            $object->save();
        }

    }

}
