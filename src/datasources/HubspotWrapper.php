<?php
namespace fortyfive\hubspotgraphql\datasources;

use fortyfive\hubspotgraphql\HubspotGraphql;
use SevenShores\Hubspot;


/**
 * Class HubspotWrapper
 *
 *  This class only has an static method to create an object that can access
 *  to the HubSpot API.
 *
 * @package fortyfive\hubspotgraphql\datasources
 */
class HubspotWrapper
{
    protected static function create() {
        return Hubspot\Factory::create(HubspotGraphql::getInstance()->getSettings()->hubspotKey);
    }
}