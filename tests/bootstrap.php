<?php
/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPPresentation/contributors.
 *
 * @see        https://github.com/PHPOffice/PHPPresentation
 *
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

declare(strict_types=1);
date_default_timezone_set('UTC');

// defining base dir for tests
if (!defined('PHPPRESENTATION_TESTS_BASE_DIR')) {
    define('PHPPRESENTATION_TESTS_BASE_DIR', realpath(__DIR__));
}

$vendor = realpath(__DIR__ . '/../vendor');

if (file_exists($vendor . '/autoload.php')) {
    require $vendor . '/autoload.php';
} else {
    $vendor = realpath(__DIR__ . '/../../../');
    if (file_exists($vendor . '/autoload.php')) {
        require $vendor . '/autoload.php';
    } else {
        throw new Exception('Unable to load dependencies');
    }
}

spl_autoload_register(function ($class): void {
    $class = ltrim($class, '\\');
    $prefix = 'PhpOffice\\PhpPresentation\\Tests';
    if (0 === strpos($class, $prefix)) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $class = implode(DIRECTORY_SEPARATOR, ['PhpPresentation', 'Tests', '_includes']) .
        substr($class, strlen($prefix));
        $file = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

require_once __DIR__ . '/../src/PhpPresentation/Autoloader.php';
\PhpOffice\PhpPresentation\Autoloader::register();
