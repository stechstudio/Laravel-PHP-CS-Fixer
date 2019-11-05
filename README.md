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
* PHP Version: ">=7.0"
* Laravel/Lumen: "^5.4|^6.0"
* PHP-CS-Fixer: "2.14.*"

## Installation

```
composer require stechstudio/laravel-php-cs-fixer
```

> **Note**: If you are using Laravel 5.5 or greater, no need to register the provider. Laravel PHP CS Fixer supports Laravel new [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

### Manually Register the Provider for Laravel 5.4:

#### Laravel 
Add the following to the `providers` array in `config/app.php`.:

```php
STS\Fixer\FixerServiceProvider::class,
```

#### Lumen
Add the following to `bootstrap/app.php`.:

```php
$app->register(STS\Fixer\FixerServiceProvider::class);
```

## Configuration
The default rule configuration is in the `fixer.php` and is intended to match the rules used by the Laravel Framework.

```php
return [
    'rules' => [
        'psr0' => false,
        '@PSR2' => true,
        'blank_line_after_namespace' => true,
        'braces' => true,
        'class_definition' => true,
        'elseif' => true,
        'function_declaration' => true,
        'indentation_type' => true,
        'line_ending' => true,
        'lowercase_constants' => true,
        'lowercase_keywords' => true,
        'method_argument_space' => [
            'ensure_fully_multiline' => true, ],
        'no_break_comment' => true,
        'no_closing_tag' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'single_blank_line_at_eof' => true,
        'single_class_element_per_statement' => [
            'elements' => ['property'],
        ],
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'visibility_required' => true,
        'encoding' => true,
        'full_opening_tag' => true,
        ],
];
```

if you want to modify this yourself, just use artisan `php artisan vendor:publish --provider="STS\Fixer\FixerServiceProvider"` 
and it will put the default configuration in 'config/fixer.php'. Check the  
[PHP-CS-Fixer/README](https://github.com/FriendsOfPHP/PHP-CS-Fixer#usage) for valid rules.

> Note: There are some static configuration settings in the finder that have yet to be moved to the configuration file 
> that you should be aware of! We plan to move these to the config file soon.

```php
$finder = Finder::create()
            ->notPath('bootstrap/cache')
            ->notPath('storage')
            ->notPath('vendor')
            ->in(base_path())
            ->name('*.php')
            ->notName('*.blade.php')
            ->ignoreDotFiles(true)
            ->ignoreVCS(true);
```

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
  fixer:fix [options]

Options:
      --path[=PATH]                    The path. (multiple values allowed)
      --path-mode[=PATH-MODE]          Specify path mode (can be override or intersection). [default: "override"]
      --allow-risky[=ALLOW-RISKY]      Are risky fixers allowed (can be yes or no).
      --config[=CONFIG]                The path to a .php_cs file.
      --dry-run                        Only shows which files would have been modified.
      --rules[=RULES]                  The Rules
      --using-cache[=USING-CACHE]      Does cache should be used (can be yes or no). [default: "yes"]
      --cache-file[=CACHE-FILE]        The path to the cache file.
      --diff                           Also produce diff for each file.
      --diff-format[=DIFF-FORMAT]      Specify diff format.
      --format[=FORMAT]                To output results in other formats.
      --stop-on-violation              Stop execution on first violation.
      --show-progress[=SHOW-PROGRESS]  Type of progress indicator (none, run-in, estimating or estimating-max).
  -h, --help                           Display this help message
  -q, --quiet                          Do not output any message
  -V, --version                        Display this application version
      --ansi                           Force ANSI output
      --no-ansi                        Disable ANSI output
  -n, --no-interaction                 Do not ask any interactive question
      --env[=ENV]                      The environment the command should run under
  -v|vv|vvv, --verbose                 Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
  
// Only shows which files would have been modified
$ php artisan fixer:fix --dry-run

// Modify the files that need to be fixed
$ php artisan fixer:fix

// Check all the files in the `app` directory
$ php artisan fixer:fix --path app --dry-run 
```
