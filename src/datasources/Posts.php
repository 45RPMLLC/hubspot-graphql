<?php 
namespace fortyfive\hubspotgraphql\datasources;

/**
 * Class Posts
 *
 * Expose two static methods to make queries to the `blogPosts` endpoint
 * of HubSpot API.
 *
 * @package fortyfive\hubspotgraphql\datasources
 */
class Posts extends HubspotWrapper
{
    /**
     * Method to get all the blog posts available
     *
     * @param array $args
     * @return \SevenShores\Hubspot\Http\Response
     */
    public static function all($args = []) {
        return self::create()->blogPosts()->all($args);
    }

    /**
     * Method to get a single blog post
     *
     * @param $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    public static function getById($id) {
        return self::create()->blogPosts()->getById($id);
    }
}