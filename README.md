# HubSpot GraphQL plugin for Craft CMS 3.x

This plugin adds a Hubspot GraphQL definition to Craft CMS. It allows to query Hubspot data and add it to your existing Craft queries
making it simpler to gather data from multiple sources as it facilitates integration with javascript frameworks used to build modern websites that heavily rely on GraphQL queries.

This plugin uses the HubSpot PHP API client and it allows to query resources from the CMS Blog API (i.e. posts, authors, topics) with more resources becoming available in the future.


## Requirements

- This plugin requires Craft CMS 3.0.0-beta.23 or later.
- [CraftQL](https://plugins.craftcms.com/craftql) plugin
- A [HubSpot Api Key](https://knowledge.hubspot.com/integrations/how-do-i-get-my-hubspot-api-key)

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require fortyfive/hubspot-graphql

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for HubSpot GraphQL.

4. Now in the Control Panel, go to Settings → HubSpot GraphQL and set your [HubSpot Api Key](https://knowledge.hubspot.com/integrations/how-do-i-get-my-hubspot-api-key)

## HubSpot GraphQL Overview

Here's an example query with all the possible information you can get.
```
{
  hubspot {
    posts(limit: 5) {
      limit
      offset
      total
      objects {
        archived
        blog_author_id
        author {
          avatar
          bio
          created
          deleted_at
          display_name
          email
          facebook
          full_name
          has_social_profiles
          id
          linkedin
          portal_id
          slug
          twitter
          twitter_username
          updated
          website
        }
        campaign
        campaign_name
        cloned_from
        comment_count
        content_group_id
        created
        deleted
        featured_image
        footer_html
        freeze_date
        has_user_changes
        head_html
        html_title
        id
        is_draft
        meta_description
        name
        performable_url
        portal_id
        post_body
        post_summary
        preview_key
        processing_status
        publish_date
        publish_immediately
        published_url
        rss_body
        rss_summary
        slug
        state
        style_override_id
        subcategory
        topic_ids
        topics {
          name
        }
        updated
        url
      }
    }
  }
}
```

## HubSpot GraphQL Roadmap

- [x] Integration with [CraftQL](https://plugins.craftcms.com/craftql) plugin
- [ ] Integration with CraftCMS GraphQL

From the desk of [45RPM](https://www.45rpm.co/)
