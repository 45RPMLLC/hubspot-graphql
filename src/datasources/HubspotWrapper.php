<?php
namespace fortyfive\hubspotgraphql\datasources;

use fortyfive\hubspotgraphql\HubspotGraphql;
use SevenShores\Hubspot;


/**
 * Class HubspotWrapper
 *
 *  A static method to create an object that can access the HubSpot API.
 *
 * @package fortyfive\hubspotgraphql\datasources
 */
class HubspotWrapper
{
    protected static function create() {
        return Hubspot\Factory::create(HubspotGraphql::getInstance()->getSettings()->hubspotKey);
    }
}