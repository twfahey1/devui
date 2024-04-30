## INTRODUCTION

A Drupal module that provides a front end for advanced site management and development tasks.

The primary use case for this module is:

- Developers working within the UI who need to rapidly perform tasks like config exports, git commits of config exports, database imports, etc.

## REQUIREMENTS

- This is imagined as a local only tool, not something that should be enabled in production.

## INSTALLATION

Install as you would normally install a contributed Drupal module.
See: https://www.drupal.org/node/895232 for further information.

## CONFIGURATION
- Configure path to drush on `/admin/config/devui/settings`
- Alternatively, have it in your `settings.local.php`:
```
$settings['devui.settings']['path_to_drush'] = '/var/www/vendor/bin/drush';
```

## MAINTAINERS

Current maintainers for Drupal 10:

- Tyler Fahey - https://www.drupal.org/u/twfahey1

