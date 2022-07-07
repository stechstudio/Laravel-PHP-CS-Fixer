<?php

return [
    /** Will show up as the configuration name when using this rules configurations. */
    'config_name' => 'Laravel Fixer',

    /** By default, we will ignore any and all dot files. */
    'ignore_dot_files' => true,

    /** By default, we will ignore all the source control metadata */
    'ignore_vcs' => true,

    /** The list of directories you want to fix. These are the default laravel directories. */
    'find_directories' => [
        base_path('/app'),
        base_path('/config'),
        database_path(),
        resource_path(),
        base_path('/routes'),
        base_path('/tests')

    ],

    /** We will fix all files in those directories that match a pattern in this list. */
    'file_name_pattern_whitelist' => [
        '*.php',
    ],

    /** However, we will not fix files that match patterns in this list. */
    'file_name_pattern_blacklist' => [
        '*.blade.php',
    ],

    /**
     * These are all the rules.
     * Find them all at https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v3.0.0/doc/rules/index.rst
     */
    'rules' => [
        /** PHP arrays should be declared using the configured syntax. */
        'array_syntax' => ['syntax' => 'short'],

        /** Binary operators should be surrounded by space as configured. */
        'binary_operator_spaces' => [
            'default' => 'single_space',
            'operators' => ['=>' => null]
        ],

        /** There MUST be one blank line after the namespace declaration. */
        'blank_line_after_namespace' => true,

        /** Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line. */
        'blank_line_after_opening_tag' => true,

        /** An empty line feed must precede any configured statement. */
        'blank_line_before_statement' => [
            'statements' => ['return']
        ],

        /** The body of each structure MUST be enclosed by braces. Braces should be properly placed. Body of braces should be properly indented. */
        'braces' => true,

        /** A single space or none should be between cast and variable. */
        'cast_spaces' => true,

        /** Class, trait and interface elements must be separated with one or none blank line. */
        'class_attributes_separation' => [
            'elements' => ['method' => 'one'],
        ],

        /** Whitespace around the keywords of a class, trait or interfaces definition should be one space. */
        'class_definition' => true,

        /** Concatenation should be spaced according configuration. */
        'concat_space' => [
            'spacing' => 'none'
        ],

        /** Equal sign in declare statement should be surrounded by spaces or not following configuration. */
        'declare_equal_normalize' => true,

        /** The keyword elseif should be used instead of else if so that all control keywords look like single words. */
        'elseif' => true,

        /** PHP code MUST use only UTF-8 without BOM (remove BOM). */
        'encoding' => true,

        /** PHP code must use the long <?php tags or short-echo <?= tags and not other tag variations. */
        'full_opening_tag' => true,

        /** Transforms imported FQCN parameters and return types in function arguments to short version. */
        'fully_qualified_strict_types' => true,

        /** Spaces should be properly placed in a function declaration. */
        'function_declaration' => true,

        /** nsure single space between function's argument and its typehint. */
        'function_typehint_space' => true,

        /** Convert heredoc to nowdoc where possible. */
        'heredoc_to_nowdoc' => true,

        /** Include/Require and file path should be divided with a single space. File path should not be placed under brackets. */
        'include' => true,

        /** Pre- or post-increment and decrement operators should be used if possible. */
        'increment_style' => ['style' => 'post'],

        /** Code MUST use configured indentation type. */
        'indentation_type' => true,

        /** Ensure there is no code on the same line as the PHP open tag. */
        'linebreak_after_opening_tag' => true,

        /** All PHP files must use same line ending. */
        'line_ending' => true,

        /** Cast should be written in lower case. */
        'lowercase_cast' => true,

        /** The PHP constants true, false, and null MUST be written using the correct casing. */
        'constant_case' => true,

        /** PHP keywords MUST be in lower case. */
        'lowercase_keywords' => true,

        /** Class static references self, static and parent MUST be in lower case. */
        'lowercase_static_reference' => true,

        /** Magic method definitions and calls must be using the correct casing. */
        'magic_method_casing' => true,

        /** Magic constants should be referred to using the correct casing */
        'magic_constant_casing' => true,

        /**
         * In method arguments and method call, there MUST NOT be a space before each comma and
         * there MUST be one space after each comma. Argument lists MAY be split across multiple
         * lines, where each subsequent line is indented once. When doing so, the first item in the
         * list MUST be on the next line, and there MUST be only one argument per line.
         */
        'method_argument_space' => true,

        /** Function defined by PHP should be called using the correct casing. */
        'native_function_casing' => true,

        /** (risky) Master functions shall be used instead of aliases. */
        'no_alias_functions' => true,

        /** Removes extra blank lines and/or blank lines following configuration. */
        'no_extra_blank_lines' => [
            'tokens' => [
                'extra',
                'throw',
                'use',
                'use_trait',
            ]
        ],
        /** There should be no empty lines after class opening brace. */
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_closing_tag' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => [
            'use' => 'echo'
        ],
        'no_multiline_whitespace_around_double_arrow' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line'
        ],
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_around_offset' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unused_imports' => true,

        /* (risky) In function arguments there must not be arguments with default values before non-default ones. */
        'no_unreachable_default_argument_value' => true,

        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'not_operator_with_successor_space' => true,
        'object_operator_without_whitespace' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'phpdoc_indent' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_no_access' => true,
        'phpdoc_no_package' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_summary' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'phpdoc_types' => true,
        'phpdoc_var_without_name' => true,

        /* (risky) Classes must be in a path that matches their namespace, be at least one namespace deep and the class name should match the file name. */
        'psr_autoloading' => true,

        /* (risky) Inside class or interface element self should be preferred to the class name itself. */
        'self_accessor' => true,

        'short_scalar_cast' => true,
        'simplified_null_return' => false, // disabled by Shift
        'single_blank_line_at_eof' => true,
        'single_blank_line_before_namespace' => true,
        'single_class_element_per_statement' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'single_line_comment_style' => [
            'comment_types' => ['hash']
        ],
        'single_quote' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'ternary_operator_spaces' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays']],
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => [
            'elements' => ['method', 'property']
        ],
        'whitespace_after_comma_in_array' => true,
    ],
];
