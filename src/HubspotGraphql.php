<?php
/**
 * HubSpot GraphQL plugin for Craft CMS 3.x
 *
 * This plugin adds a GraphQL definition to access HubSpot CMS Blog API
 *
 * @link      https://www.45rpm.co/
 * @copyright Copyright (c) 2020 45RPM
 */

namespace fortyfive\hubspotgraphql;

use fortyfive\hubspotgraphql\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use fortyfive\hubspotgraphql\listeners\GetCraftQLSchema;
use markhuot\CraftQL\CraftQL;
use markhuot\CraftQL\Builders\Schema;
use markhuot\CraftQL\Events\AlterSchemaFields;

use yii\base\Event;

/**
 * Class HubspotGraphql
 *
 * @author    45RPM
 * @package   HubspotGraphql
 * @since     1.0.0
 *
 */
class HubspotGraphql extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var HubspotGraphql
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;
        $craft33 = version_compare(Craft::$app->getVersion(), '3.3', '>=');

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'hubspot-graphql',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );

        // CraftQL Support
        if (class_exists(CraftQL::class)) {
            Event::on(
                Schema::class,
                AlterSchemaFields::EVENT,
                [new GetCraftQLSchema, 'handle']
            );
        }
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'hubspot-graphql/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
