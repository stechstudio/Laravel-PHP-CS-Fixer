# Laravel PHP CS Fixer

The PHP CS Fixer is maintained on GitHub at https://github.com/FriendsOfPHP/PHP-CS-Fixer
bug reports and ideas about new features are welcome there.

> The PHP Coding Standards Fixer (PHP CS Fixer) tool fixes your code to follow standards;
  whether you want to follow PHP coding standards as defined in the PSR-1, PSR-2, etc.,
  or other community driven ones like the Symfony one.
  You can **also** define your (teams) style through configuration.
  
This package makes it easier than ever to use PHP CS Fixer to maintain your laravel code by providing access to it via 
tools that you are already familiar with. An artisan command to fix the code, and manage the configuration the way you
do all the other laravel packages you use.

# Features of this package
* Run PHP-CS-Fixer commands via Laravel Artisan CLI.
* Laravel Code Style Configuration Used by Default.
* No need to learn a new tool.

## Versions and compatibility
> **Note:** This documentation was written for Laravel 5.5.
* PHP Version: "^7.1.3 || ^8.0"
* Laravel/Lumen: "^5.4|^6.0|^7.0|^8.0"
* PHP-CS-Fixer: "^3.0.0"

## Installation

```
composer require stechstudio/laravel-php-cs-fixer
```

## Configuration
The default rule configuration is in the [fixer.php](https://github.com/stechstudio/Laravel-PHP-CS-Fixer/blob/master/config/fixer.php) and is intended to match the rules used by Laravel Shift.

if you want to modify this yourself, just use artisan `php artisan vendor:publish --provider="STS\Fixer\FixerServiceProvider"` 
and it will put the default configuration in 'config/fixer.php'. Check the  
[PHP-CS-Fixer/README](https://github.com/FriendsOfPHP/PHP-CS-Fixer#usage) for valid rules.

## Usage
#### Fix Your Code
Fix your code with Laravel Coding Standards.

Syntax:
```
$ php artisan fixer:fix [options]
```

Example:
```
Usage:
  fixer:fix [options] [--] [<path>...]

Arguments:
  path                               The path. Can be a list of space separated paths

Options:
      --path-mode=PATH-MODE          Specify path mode (can be override or intersection). [default: "override"]
      --allow-risky=ALLOW-RISKY      Are risky fixers allowed (can be yes or no).
      --config=CONFIG                The path to a .php-cs-fixer.php file.
      --dry-run                      Only shows which files would have been modified.
      --rules=RULES                  The rules.
      --using-cache=USING-CACHE      Does cache should be used (can be yes or no).
      --cache-file=CACHE-FILE        The path to the cache file.
      --diff                         Also produce diff for each file.
      --format=FORMAT                To output results in other formats.
      --stop-on-violation            Stop execution on first violation.
      --show-progress=SHOW-PROGRESS  Type of progress indicator (none, dots).
  -h, --help                         Display help for the given command. When no command is given display help for the list command
  -q, --quiet                        Do not output any message
  -V, --version                      Display this application version
      --ansi                         Force ANSI output
      --no-ansi                      Disable ANSI output
  -n, --no-interaction               Do not ask any interactive question
      --env[=ENV]                    The environment the command should run under
  -v|vv|vvv, --verbose               Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
  
```
