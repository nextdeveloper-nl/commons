<?php

namespace NextDeveloper\Commons\Services;

use NextDeveloper\Commons\Exceptions\CannotCreateModelException;
use NextDeveloper\Commons\Services\AbstractServices\AbstractDomainsService;

/**
 * This class is responsible from managing the data for Domains
 *
 * Class DomainsService.
 *
 * @package NextDeveloper\Commons\Database\Models
 */
class DomainsService extends AbstractDomainsService
{

    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    public static function create($data)
    {
        try {
            return parent::create($data);
        } catch (\Exception $e) {
            switch ($e->getCode()) {
                case 23505:
                    throw new CannotCreateModelException('Cannot create this domain because there is exactly the same domain existing in the database.');
            }
        }
    }
}
