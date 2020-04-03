<?php
/**
 * HubSpot GraphQL plugin for Craft CMS 3.x
 *
 * This plugin adds a GraphQL definition to have access to the Blog HubSpot API - important CraftQL plugin is required.
 *
 * @link      https://www.45rpm.co/
 * @copyright Copyright (c) 2020 45RPM
 */

namespace fortyfive\hubspotgraphql\models;

use fortyfive\hubspotgraphql\HubspotGraphql;

use Craft;
use craft\base\Model;

/**
 * @author    45RPM
 * @package   HubspotGraphql
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $hubspotKey;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['hubspotKey', 'string'],
        ];
    }
}
