# Sign in Popup module for Magento 2

[![GitHub license](https://img.shields.io/github/license/Naereen/StrapDown.js.svg)](https://choosealicense.com/licenses/mit/)
[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](mailto:dev@nikitaisakov.com?subject=[GitHub]%20Ask%20me%20anything)
[![Contributions welcome](https://img.shields.io/badge/Contributions-welcome-brightgreen.svg?style=flat)](https://github.com/razzzila-dev/golang-server-metrix-client/issues)

![FPC support](https://img.shields.io/badge/FPC-supported-green.svg)
![Tested on >= Magento 2.3.2](https://img.shields.io/badge/Tested%20on->=%20Magento%202.3.2-f26322.svg)
![No DB Migrations](https://img.shields.io/badge/Deploy-No%20DB%20Migrations-26A2AA.svg)

Working with clients sometimes you want to add some privileges for some of them over other.
Most simple example is to show the dedicated phone number of support for VIP customers.
But it could be any content: images, text, even sliders, etc.

So here is the solution for this problem. Since mostly for displaying some content we use the static blocks, I just added new widget which have "Access Controll List" by Customer groups.

Works with FPC as well.

## Installation
### Package install
#### Manual installation
Download archive and unzip it.
Then move all files from `module-static-block-by-customer-group` folder to the `<magento_root>/app/code/Razzzila/StaticBlockACL` folder.

#### Using Composer
Change working directory to `<magento_root>` and run:
```BASH
composer require razzzila-dev/module-static-block-by-customer-group
bin/magento module:enable Razzzila_StaticBlockACL
bin/magento cache:flush
```

## Usage
Let's create 2 blocks: one with default support number inside and another one with a dedicated phone number for VIP customers.

For doing so, in the admin panel open Content -> Blocks and click "Add new block" button. Fill fields and click "Save & Duplicate". Enable block, change Identifier, Block title, and Content (replace with a dedicated number) and click "Save".

Now navigate to Block or Page where you want to put a dynamic block (based on the customer group).
In the content editor click on "Insert Widget" and choose "Static Block ACL".
The first block will be default one, so choose the block with default phone number and choose groups for whom you want to show it (all except VIP group).
The second one will be for VIP customers only. Right after the widget from above create another one but here choose the block with dedicated for VIP customers phone number and choose VIP customer group.
Save the page/block.

To apply changes navigate to the Cache Management and Refresh the FPC(Full Page Cache).

## Support
This module is not my priority, so in time support not guaranteed. But feel free to open new issues and create pull-requests if needed.

## License
[MIT](https://choosealicense.com/licenses/mit/)
