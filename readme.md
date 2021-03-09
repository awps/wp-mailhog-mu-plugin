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
      ".srv/wordpress/wp-content/mu-plugins/{$name}/": [ "type:wordpress-muplugin"]
    }
},
```

### Add the Mailhog configuration in `docker-compose.yml`
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

### Lastly, add the loader inside of `mu-plugins`. 
By default, MU Plugins can't be loaded from folders, they must be one single file. Hopefully we can trick the system by loading all 
plugins that follow a simple pattern. See this gist for details.
https://gist.github.com/awps/9d9d97ef743d78f32f10ca78d2ba1746

Save this code in a file and place it inside `mu-plugins` dir.
```
<?php
$flags = \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS;
$iterator = new \FilesystemIterator(__DIR__, $flags);

foreach ($iterator as $path => $item) {
    if ($item->isDir()) {
        $muPath = trailingslashit($path);
        $fileName = basename($item->getFileName());
        $filePath = "{$muPath}/{$fileName}.php";

        if (file_exists($filePath)) {
            require_once $filePath;
        }
    }
}
```
