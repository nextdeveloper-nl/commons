<?php

namespace NextDeveloper\Commons\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use NextDeveloper\Commons\Database\Models\Domains;
use NextDeveloper\Commons\Database\Models\Taggables;
use NextDeveloper\Commons\Database\Models\Tags;
use NextDeveloper\Commons\Exceptions\ModelNotFoundException;
use NextDeveloper\Commons\Helpers\TagHelper;
use NextDeveloper\Commons\Services\AbstractServices\AbstractTaggablesService;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
* This class is responsible from managing the data for Taggables
*
* Class TaggablesService.
*
* @package NextDeveloper\Commons\Database\Models
*/
class TaggablesService extends AbstractTaggablesService {

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    public static function create(array $data)
    {
        $data['object_type'] = (new TagHelper())->getObject($data['object_type']);

        if(!$data['object_type'])
            throw new ModelNotFoundException('Cannot find the object type you are looking for. If you think this is'
                . ' wrong, please look at your configuration and give me the correct model name.');

        $obj = app($data['object_type'])->where('uuid', $data['object_id'])->first();

        if(!$obj) {
            throw new ModelNotFoundException('Cannot find the domain you are looking for. Make sure that domain'
                . ' is in your account.');
        }

        $data['object_id'] = app($data['object_type'])::where('uuid', $data['object_id'])->first()->id;

        try {
            return parent::create($data); // TODO: Change the autogenerated stub
        } catch (QueryException $exception) {
            //  If we get this exception then this means that we have exactly the same object. So we look at the db
            //  and return back the related object.
            if($exception->getCode() == 23000) {
                $tag = Tags::where('uuid', $data['common_tags_id'])->first();
                $data['common_tags_id'] = $tag->id;
                return Taggables::where($data)->first();
            }
        }
    }

    public static function createWithTag(array $data) : Taggables {
        $tag = (new TagHelper())->getTag($data['tag']);

        $taggable = self::create([
            'object_type'       =>  $data['object_type'],
            'object_id'         =>  $data['object_id'],
            'common_tags_id'    =>  $tag->uuid
        ]);

        return $taggable;
    }

    public static function deleteWithTag($objectType, $objectId, $tag) {
        $tag = (new TagHelper())->getTag($tag);

        Taggables::where([
            'object_type'   =>  $objectType,
            'object_id'     =>  $objectId,
            'common_tags_id'    =>  $tag->id
        ])->first()->delete();

        return true;
    }
}
