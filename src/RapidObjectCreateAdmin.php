<?php

namespace Vulcan\RapidObjectCreateAdmin;

use LittleGiant\SingleObjectAdmin\SingleObjectAdmin;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;

/**
 * Same functionality as SingleObjectAdmin but instead of editing a single record, you can create many records rapidly
 *
 * @package Vulcan\RapidObjectCreate
 *
 * @author Reece Alexander
 */
class RapidObjectCreateAdmin extends SingleObjectAdmin
{
    public function canView($member = null)
    {
        return Permission::check("CMS_ACCESS_SingleObjectAdmin_Create");
    }

    public function providePermissions()
    {
        return [
            "CMS_ACCESS_RapidObjectCreate_Create" => [
                'name'     => "Access to create new records in Single Object Administration",
                'category' => 'CMS Access',
                'help'     => 'Allow the creation of new records in Single Object Administration'
            ]
        ];
    }

    /**
     * @return DataObject
     */
    public function getCurrentObject()
    {
        $objectClass = $this->config()->get('tree_class');

        /** @var DataObject|Versioned $object */
        $object = $objectClass::create();

        return $object;
    }
}