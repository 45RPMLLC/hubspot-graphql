<?php
namespace fortyfive\hubspotgraphql\listeners;

use fortyfive\hubspotgraphql\datasources\Posts;
use fortyfive\hubspotgraphql\datasources\Topics;
use markhuot\CraftQL\Events\AlterSchemaFields;
use markhuot\CraftQL\Builders\Field as FieldBuilder;

/**
 * Class GetCraftQLSchema
 *
 * @package fortyfive\hubspotgraphql\listeners
 */
class GetCraftQLSchema
{
    /**
     * Method that creates the CraftQL definition for blog Posts
     *
     * @param AlterSchemaFields $event
     */
    function handle (AlterSchemaFields $event)
    {
        $authorType = $event->schema->createObjectType('author');
        $authorType->addStringField('avatar');
        $authorType->addStringField('bio');
        $authorType->addStringField('created');
        $authorType->addStringField('deleted_at');
        $authorType->addStringField('display_name');
        $authorType->addStringField('email');
        $authorType->addStringField('facebook');
        $authorType->addStringField('full_name');
        $authorType->addBooleanField('has_social_profiles');
        $authorType->addStringField('id');
        $authorType->addStringField('linkedin');
        $authorType->addStringField('portal_id');
        $authorType->addStringField('slug');
        $authorType->addStringField('twitter');
        $authorType->addStringField('twitter_username');
        $authorType->addStringField('updated');
        $authorType->addStringField('website');

        $topicType = $event->schema->createObjectType('topic');
        $topicType->addStringField('id');
        $topicType->addStringField('portalId');
        $topicType->addStringField('name');
        $topicType->addStringField('slug');
        $topicType->addStringField('description');
        $topicType->addStringField('created');
        $topicType->addStringField('updated');
        $topicType->addStringField('deletedAt');

        $postType = $event->schema->createObjectType('post');
        $postType->addBooleanField('archived');
        $postType->addStringField('blog_author_id');
        $postType->addStringField('campaign');
        $postType->addStringField('campaign_name');
        $postType->addStringField('cloned_from');
        $postType->addIntField('comment_count');
        $postType->addStringField('content_group_id');
        $postType->addStringField('created');
        $postType->addStringField('deleted');
        $postType->addStringField('featured_image');
        $postType->addStringField('footer_html');
        $postType->addStringField('freeze_date');
        $postType->addBooleanField('has_user_changes');
        $postType->addStringField('head_html');
        $postType->addStringField('html_title');
        $postType->addStringField('id');
        $postType->addBooleanField('is_draft');
        $postType->addStringField('meta_description');
        $postType->addStringField('name');
        $postType->addStringField('performable_url');
        $postType->addStringField('portal_id');
        $postType->addStringField('post_body');
        $postType->addStringField('post_summary');
        $postType->addStringField('preview_key');
        $postType->addStringField('processing_status');
        $postType->addStringField('publish_date');
        $postType->addStringField('publish_immediately');
        $postType->addStringField('published_url');
        $postType->addStringField('rss_body');
        $postType->addStringField('rss_summary');
        $postType->addStringField('slug');
        $postType->addStringField('state');
        $postType->addStringField('style_override_id');
        $postType->addStringField('subcategory');
        $postType->addField('topic_ids')->lists();
        $postType->addStringField('updated');
        $postType->addStringField('url');
        $postType->addField('author')
                    ->type($authorType)
                    ->resolve(function($root, $args, $context, $info) {
                        return $root['blog_post_author'];
                    });
        $postType->addField('topics')
                    ->type($topicType)
                    ->lists()
                    ->resolve(function($root, $args, $context, $info) {
                         $topics = Topics::getByIds(implode(',', $root['topic_ids']));
                         return !empty($topics['objects']) ? $topics['objects'] : [];
                    });


        $postObjectsType = $event->schema->createObjectType('posts');
        $postObjectsType->addIntField('limit');
        $postObjectsType->addIntField('offset');
        $postObjectsType->addIntField('total');
        $postObjectsType->addField('objects')->type($postType)->lists();

        $queryType = $event->schema->createObjectType('query');
        $queryType->addField('posts')
                    ->type($postObjectsType)
                    ->arguments(function(FieldBuilder $field) {
                        $field->addStringArgument('content_group_id')->description('Returns the posts that match the blog guid.');
                        $field->addIntArgument('limit')->description('The number of items to return. Defaults to 20. Cannot exceed 300.');
                        $field->addIntArgument('offset')->description('The offset set to start returning rows from. Defaults to 0.');
                        $field->addBooleanArgument('archived')->description('If Blog Post is or not archived.');
                        $field->addStringArgument('blog_author_id')->description('Returns the posts that match a particular blog author ID value.');
                        $field->addStringArgument('campaign')->description('Returns the posts that match the campaign GUID.');
                        $field->addStringArgument('created')->description('Returns the posts that match a particular created time value. Supports exact, range, gt, gte, lt, lte lookups.');
                        $field->addStringArgument('deleted_at')->description('Returns the posts that match a particular deleted time value. Supports exact, gt, gte, lt, lte lookups.');
                        $field->addStringArgument('name')->description('Returns the posts that match the name value. Supports exact, contains, icontains, ne lookups.');
                        $field->addStringArgument('slug')->description('Returns the posts that match a particular slug value.');
                        $field->addStringArgument('updated')->description('Returns the posts that match a particular updated time. Supports exact, range, gt, gte, lt, lte lookups.');
                        $field->addStringArgument('state')->description('Returns the posts that match a particular state. The allowed values are: DRAFT, PUBLISHED, or SCHEDULED.');
                        $field->addStringArgument('order_by')->description('Return the posts ordered by a particular field value. Blog posts can currently only be sorted by publish_date. Use a negative value to sort in descending order (e.g. order_by=-publish_date).');
                    })->resolve(function($root, $args, $context, $info) {
                        return Posts::all($args);
                    });

        $event->schema->addField('hubspot')
                        ->type($queryType)
                        ->resolve(function($root, $args, $context, $info) {
                                return $args;
                        });
    }



}