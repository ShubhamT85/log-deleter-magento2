# Magento 2(Delete Logs via keyword)
1. This module helps in deleting multiple log files of similar keyword all at once.
2. Admin menu named **DELETE LOGS** is created for deleting logs.
## Basic Flow of the module
- Firstly, after cloning the git and extracting the folder wrap it inside folder **DeleteLog** and again wrap this folder in **Task** so inshort, create your directory as magento-root-directory/app/code/Task/DeleteLog/cloned_directory.
- After that open the magento root directory in terminal and hit the following commands,
  - `sudo php bin/magento module:enable Task_DeleteLog`
  - `sudo php bin/magento setup:upgrade`
  - `sudo php bin/magento setup:di:compile`
  - `sudo php bin/magento setup:static-content:deploy -f`
  - `sudo php bin/magento indexer:reindex` (optional)
  - `sudo php bin/magento cache:flush`
  - `sudo chmod 777 -R var/ pub/ generated/`
- Now, open your web browser and type in the following link to open magento admin (assuming for localhost or else type in https://your-magento-from-ftp/admin) **localhost/magento-root-directory/admin** you will see an admin menu named **DELETE LOGS**.
- On clicking the admin menu you will be redirected to an input text field with a submit button , enter the desired keyword through which you want all your associated log files to that keyword gets deleted for eg: test.
- Click on submit and then you will get one of the two messages:
  1. *All files related to test are deleted* - log files containing names such as test_for_search, 1test, TEST_address_issue, etc. all gets deleted at once.
  2. *No files found* - either you have provided a fake or mistaken keyword else the searched keyword has no found results i.e. such keyword-named file doesn't exist.

### Happy Coding :)


