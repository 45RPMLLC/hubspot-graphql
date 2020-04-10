<?php
namespace fortyfive\hubspotgraphql\datasources;

/**
 *  Class Topics
 *
 * @package fortyfive\hubspotgraphql\datasources
 */
class Topics extends HubspotWrapper
{
    /**
     * Method to get an array of topics by their IDs
     *
     * @param $ids
     * @return \SevenShores\Hubspot\Http\Response
     */
    public static function getByIds($ids){
        return self::create()->blogTopics()->all(['id__in' => $ids]);
    }

}
