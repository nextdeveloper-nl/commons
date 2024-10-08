<?php

namespace NextDeveloper\Commons\Database\Observers;

use Illuminate\Database\Eloquent\Model;
use NextDeveloper\Commons\Exceptions\DomainValidationException;
use NextDeveloper\Commons\Exceptions\NotAllowedException;
use NextDeveloper\Commons\Helpers\DomainsHelper;
use NextDeveloper\Events\Services\Events;
use NextDeveloper\IAM\Helpers\UserHelper;
use Throwable;

/**
 * Class DomainsObserver
 *
 * @package NextDeveloper\Commons\Database\Observers
 */
class DomainsObserver
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

        //self::throwIfDomainIsInvalid($model);

        Events::fire('creating:NextDeveloper\Commons\Domains', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function created(Model $model)
    {
        Events::fire('created:NextDeveloper\Commons\Domains', $model);
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

        //self::throwIfDomainIsInvalid($model);

        Events::fire('saving:NextDeveloper\Commons\Domains', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function saved(Model $model)
    {
        Events::fire('saved:NextDeveloper\Commons\Domains', $model);
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

        self::throwIfDomainIsInvalid($model);

        Events::fire('updating:NextDeveloper\Commons\Domains', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function updated(Model $model)
    {
        Events::fire('updated:NextDeveloper\Commons\Domains', $model);
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

        Events::fire('deleting:NextDeveloper\Commons\Domains', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function deleted(Model $model)
    {
        Events::fire('deleted:NextDeveloper\Commons\Domains', $model);
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

        Events::fire('restoring:NextDeveloper\Commons\Domains', $model);
    }

    /**
     * @param Model $model
     *
     * @return mixed
     */
    public function restored(Model $model)
    {
        Events::fire('restored:NextDeveloper\Commons\Domains', $model);
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    /**
     * @throws DomainValidationException|Throwable
     */
    private static function throwIfDomainIsInvalid(Model $model): void
    {
        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $domain = $model->name;

        throw_unless(
            DomainsHelper::allowNonFqdn() || DomainsHelper::isFQDN($domain),
            new DomainValidationException($domain)
        );
    }
}
