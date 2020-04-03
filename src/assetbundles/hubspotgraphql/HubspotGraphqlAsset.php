<?php
/**
 * HubSpot GraphQL plugin for Craft CMS 3.x
 *
 * This plugin adds a GraphQL definition to have access to the Blog HubSpot API - important CraftQL plugin is required.
 *
 * @link      https://www.45rpm.co/
 * @copyright Copyright (c) 2020 45RPM
 */

namespace fortyfive\hubspotgraphql\assetbundles\HubspotGraphql;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    45RPM
 * @package   HubspotGraphql
 * @since     1.0.0
 */
class HubspotGraphqlAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@fortyfive/hubspotgraphql/assetbundles/hubspotgraphql/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/HubspotGraphql.js',
        ];

        $this->css = [
            'css/HubspotGraphql.css',
        ];

        parent::init();
    }
}
