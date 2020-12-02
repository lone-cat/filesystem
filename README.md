# filesystem
filesystem utils


{
  "type": "project",
  "license": "proprietary",
  "require": {
    "php": ">=7.4"
  },
  "require-dev": {
  },
  "config": {
    "optimize-autoloader": true,
    "preferred-install": {
      "*": "dist"
    },
    "sort-packages": true
  },
  "autoload": {
    "psr-4": {
      "App\\": "src/"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "App\\Tests\\": "tests/"
    }
  },
  "replace": {
    "paragonie/random_compat": "2.*",
    "symfony/polyfill-ctype": "*",
    "symfony/polyfill-iconv": "*",
    "symfony/polyfill-php72": "*",
    "symfony/polyfill-php71": "*",
    "symfony/polyfill-php70": "*",
    "symfony/polyfill-php56": "*"
  },
  "scripts": {
  },
  "conflict": {

  },
  "extra": {

  }
}
