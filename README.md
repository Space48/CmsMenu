# CmsMenu
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Space48/CmsMenu/badges/quality-score.png?b=master&s=2ef036b4914a67ab3a7629d4a7cd722d422fee77)](https://scrutinizer-ci.com/g/Space48/CmsMenu/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Space48/CmsMenu/badges/build.png?b=master&s=cfd32528f9ec408b7280749154c22c49933d53d3)](https://scrutinizer-ci.com/g/Space48/CmsMenu/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Space48/CmsMenu/badges/coverage.png?b=master&s=058641925edf8931d988a11aa92003121356a4ba)](https://scrutinizer-ci.com/g/Space48/CmsMenu/?branch=master)

This Magento 2 module replaces the core top navigation menu. Instead it renders the top level category and allows you to assign CMS block already created to create the submenus.

![prams___pushchairs___categories___inventory___products___magento_admin_at_winstanleys_pramworld](https://user-images.githubusercontent.com/1080386/30594708-e2862734-9d46-11e7-8da8-fc941eb89514.jpg)

## Installation

**Manually:**

To install this module copy the code from this repo to `app/code/Space48/CmsMenu` folder in your Magento 2 instance, then you need to run the following commands from the terminal:

1. `bin/magento setup:upgrade`
2. `bin/magento indexer:reindex`

**Via composer:**

From the terminal execute the following commands:

1. `composer config repositories.space48-cms-menu vcs git@github.com:Space48/CmsMenu.git`
2. `composer require "space48/cmsmenu:{release-version}"`
3. `bin/magento setup:upgrade`
4. `bin/magento indexer:reindex`

**Using Modman (Good for development):**

From the terminal execute the following:

1. `modman init` (in case modman directory is not already there)
2. `modman clone git@github.com:Space48/CmsMenu.git`
3. `bin/magento setup:upgrade`
4. `bin/magento indexer:reindex`

## How to use it

Once installed...

1. Go to the `Content -> Elements -> Blocks` and create or edit the block you want to use as a sub menu.
2. Save changes.
3. Go to the `Admin Penel -> Products -> Categories` and select the category you want to assign the sub menu to.
4. Under `Content` section look for a dropdown option labelled `Menu CMS Block`.
5. Select the block you want to use.
6. Save changes.
7. Flush Magento cache.

## Troubleshooting
If you have done the previous steps and still cannot see the sub menus or you get an error message saying that `cms_block_menu` column is missing, try reindexing the flat tables related to categories.
