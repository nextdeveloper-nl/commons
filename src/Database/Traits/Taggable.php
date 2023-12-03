<?php
/**
 * This file is part of the PlusClouds.Core library.
 *
 * (c) Semih Turna <semih.turna@plusclouds.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NextDeveloper\Commons\Database\Traits;

use NextDeveloper\Commons\Database\Models\ViewTags;
use NextDeveloper\Commons\Services\TaggablesService;

/**
 * Trait Filterable
 * @package PlusClouds\Core\Database\Traits
 */
trait Taggable
{
    /**
     * Tag the object with a tag
     *
     * @internal
     * @param $tag
     * @return void
     */
    public function tag($tag) {
        TaggablesService::createWithTag([
            'object_type'   =>  get_class($this),
            'object_id'     =>  $this->id,
            'tag'           =>  $tag
        ]);
    }

    /**
     * Gets the list of tags of the related object
     *
     * @return mixed
     */
    public function tags() {
        $tags = ViewTags::where([
            'object_type'   =>  get_class($this),
            'object_id'     =>  $this->id
        ])->get();

        return $tags;
    }

    /**
     * Untags a specific tag from the object
     *
     * @internal
     * @param $tag
     * @return mixed
     */
    public function untag($tag = null) {
        TaggablesService::deleteWithTag(
            get_class($this),
            $this->id,
            $tag
        );

        return $this->tags();
    }
}
