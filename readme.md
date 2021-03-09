# WordPress MailHog MU Plugin

WordPress Mailhog MU Plugin. 
Designed to be used in tandem with docker-compose.

### Install it as a dev dependency:
```
composer require awps/wp-mailhog-mu-plugin --dev
```

### Add the instructions for plugin location:
**Note:** Replace `.srv/wordpress/` with the path of your WP installation.
```
"extra": {
    "installer-paths": {
      ".srv/wordpress/wp-content/plugins/{$name}/": [ "type:wordpress-muplugin"]
    }
},
```

### Lastly, add the Mailhog configuration in `docker-compose.yml`
```
version: '3'
services:
    # ... other services
    mailhog:
        image: mailhog/mailhog
        ports:
            - 1025:1025 # smtp server
            - 8025:8025 # web ui
```
