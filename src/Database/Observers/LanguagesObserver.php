<?php

namespace NextDeveloper\Commons\Database\Observers;

use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Exceptions\NotAllowedException;
use NextDeveloper\Events\Services\Events;
use NextDeveloper\IAM\Helpers\UserHelper;

/**
 * Class LanguagesObserver
 *
 * @package NextDeveloper\Commons\Database\Observers
 */
class LanguagesObserver
{
    /**
     * Triggered when a new record is retrieved.
     *
     * @param Model $model
     */
    public function retrieved(Model $model)
    {

    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function creating(Model $model)
    {
        throw_if(
            !UserHelper::can('create', $model),
            new NotAllowedException('You are not allowed to create this record')
        );

        Events::fire('creating:NextDeveloper\Commons\Languages', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function created(Model $model)
    {
        Events::fire('created:NextDeveloper\Commons\Languages', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function saving(Model $model)
    {
        throw_if(
            !UserHelper::can('save', $model),
            new NotAllowedException('You are not allowed to save this record')
        );

        Events::fire('saving:NextDeveloper\Commons\Languages', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function saved(Model $model)
    {
        Events::fire('saved:NextDeveloper\Commons\Languages', $model);
    }


    /**
     * @param Model $model
     */
    public function updating(Model $model)
    {
        throw_if(
            !UserHelper::can('update', $model),
            new NotAllowedException('You are not allowed to update this record')
        );

        Events::fire('updating:NextDeveloper\Commons\Languages', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function updated(Model $model)
    {
        Events::fire('updated:NextDeveloper\Commons\Languages', $model);
    }


    /**
     * @param Model $model
     */
    public function deleting(Model $model)
    {
        throw_if(
            !UserHelper::can('delete', $model),
            new NotAllowedException('You are not allowed to delete this record')
        );

        Events::fire('deleting:NextDeveloper\Commons\Languages', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function deleted(Model $model)
    {
        Events::fire('deleted:NextDeveloper\Commons\Languages', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function restoring(Model $model)
    {
        throw_if(
            !UserHelper::can('restore', $model),
            new NotAllowedException('You are not allowed to restore this record')
        );

        Events::fire('restoring:NextDeveloper\Commons\Languages', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function restored(Model $model)
    {
        Events::fire('restored:NextDeveloper\Commons\Languages', $model);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE
}
