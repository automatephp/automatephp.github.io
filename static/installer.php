<?php

/**
 *  freely inspired by box2 project
 * @see https://github.com/box-project/box2/blob/gh-pages/installer.php
 */

namespace

{

    use Humbug\SelfUpdate\VersionParser;

    $n = PHP_EOL;

    set_error_handler(
        function ($code, $message, $file, $line) use ($n) {
            if ($code & error_reporting()) {
                echo "$n{$n}Error: $message$n$n";
                exit(1);
            }
        }
    );

    echo "Automate Installer$n";
    echo "=============$n$n";

    echo "Environment Check$n";
    echo "-----------------$n$n";

    echo "\"-\" indicates success.$n";
    echo "\"*\" indicates error.$n$n";

    // check version
    check(
        'You have a supported version of PHP (>= 5.6).',
        'You need PHP 5.6 or greater.',
        function () {
            return version_compare(PHP_VERSION, '5.6', '>=');
        }
    );

    // check phar extension
    check(
        'You have the "phar" extension installed.',
        'You need to have the "phar" extension installed.',
        function () {
            return extension_loaded('phar');
        }
    );

    // check phar extension version
    check(
        'You have a supported version of the "phar" extension.',
        'You need a newer version of the "phar" extension (>=2.0).',
        function () {
            $phar = new ReflectionExtension('phar');

            return version_compare($phar->getVersion(), '2.0', '>=');
        }
    );

    // check suhosin setting
    if (extension_loaded('suhosin')) {
        check(
            'The "phar" stream wrapper is allowed by suhosin.',
            'The "phar" stream wrapper is blocked by suhosin.',
            function () {
                $white = ini_get('suhosin.executor.include.whitelist');
                $black = ini_get('suhosin.executor.include.blacklist');

                if ((false === stripos($white, 'phar'))
                    || (false !== stripos($black, 'phar'))) {
                    return false;
                }

                return true;
            }
        );
    }

    // check allow url open setting
    check(
        'The "allow_url_fopen" setting is on.',
        'The "allow_url_fopen" setting needs to be on.',
        function () {
            return (true == ini_get('allow_url_fopen'));
        }
    );

    // check apc cli caching
    if (!defined('HHVM_VERSION') && !extension_loaded('apcu') && extension_loaded('apc')) {
        check(
            'The "apc.enable_cli" setting is off.',
            'Notice: The "apc.enable_cli" is on and may cause problems with Phars.',
            function () {
                return (false == ini_get('apc.enable_cli'));
            },
            false
        );
    }

    echo "{$n}Everything seems good!$n$n";

    echo "Download$n";
    echo "--------$n$n";

    // Retrieve last version
    echo " - Check last version...$n";

    $package = json_decode(file_get_contents('https://packagist.org/packages/automate/automate.json'), true);

    if (null === $package || json_last_error() !== JSON_ERROR_NONE) {
        echo 'Error parsing JSON package data' . function_exists('json_last_error_msg') ? ': ' . json_last_error_msg() : '';
    }

    echo " - Reading manifest...$n";

    $versions = array_keys($package['package']['versions']);
    $versionParser = new VersionParser($versions);

    $current = $versionParser->getMostRecentStable();

    if (!$current) {
        echo "$n * No application download was found.$n$n";
        exit;
    }

    echo " - Downloading Automate v", $current, "...$n";

    file_put_contents('automate.phar', file_get_contents(getDownloadUrl($package, $current)));

    try {
        new Phar('automate.phar');
    } catch (Exception $e) {
        echo " x The Phar is not valid.\n\n";

        throw $e;
    }

    echo " - Making Automate executable...$n";

    @chmod('automate.phar', 0755);

    echo "{$n}Automate installed!$n";

    /**
     * Checks a condition, outputs a message, and exits if failed.
     *
     * @param string   $success   The success message.
     * @param string   $failure   The failure message.
     * @param callable $condition The condition to check.
     * @param boolean  $exit      Exit on failure?
     */
    function check($success, $failure, $condition, $exit = true)
    {
        global $n;

        if ($condition()) {
            echo ' - ', $success, $n;
        } else {
            echo ' * ', $failure, $n;

            if ($exit) {
                exit(1);
            }
        }
    }

    function getDownloadUrl(array $package, $version)
    {
        $baseUrl = preg_replace(
            '{\.git$}',
            '',
            $package['package']['versions'][$version]['source']['url']
        );
        $downloadUrl = sprintf(
            '%s/releases/download/%s/%s',
            $baseUrl,
            $version,
            'automate.phar'
        );
        return $downloadUrl;
    }
}

namespace Humbug\SelfUpdate

{


    class VersionParser
    {

        /**
         * @var array
         */
        private $versions;

        /**
         * @var string
         */
        private $modifier = '[._-]?(?:(stable|beta|b|RC|alpha|a|patch|pl|p)(?:[.-]?(\d+))?)?([.-]?dev)?';

        /**
         * @param array $versions
         */
        public function __construct(array $versions = array())
        {
            $this->versions = $versions;
        }

        /**
         * Get the most recent stable numbered version from versions passed to
         * constructor (if any)
         *
         * @return string
         */
        public function getMostRecentStable()
        {
            return $this->selectRecentStable();
        }

        /**
         * Get the most recent unstable numbered version from versions passed to
         * constructor (if any)
         *
         * @return string
         */
        public function getMostRecentUnStable()
        {
            return $this->selectRecentUnstable();
        }

        /**
         * Get the most recent stable or unstable numbered version from versions passed to
         * constructor (if any)
         *
         * @return string
         */
        public function getMostRecentAll()
        {
            return $this->selectRecentAll();
        }

        /**
         * Checks if given version string represents a stable numbered version
         *
         * @param string $version
         * @return bool
         */
        public function isStable($version)
        {
            return $this->stable($version);
        }

        /**
         * Checks if given version string represents a 'pre-release' version, i.e.
         * it's unstable but not development level.
         *
         * @param string $version
         * @return bool
         */
        public function isPreRelease($version)
        {
            return !$this->stable($version) && !$this->development($version);
        }

        /**
         * Checks if given version string represents an unstable or dev-level
         * numbered version
         *
         * @param string $version
         * @return bool
         */
        public function isUnstable($version)
        {
            return !$this->stable($version);
        }

        /**
         * Checks if given version string represents a dev-level numbered version
         *
         * @param string $version
         * @return bool
         */
        public function isDevelopment($version)
        {
            return $this->development($version);
        }

        private function selectRecentStable()
        {
            $candidates = array();
            foreach ($this->versions as $version) {
                if (!$this->stable($version)) {
                    continue;
                }
                $candidates[] = $version;
            }
            if (empty($candidates)) {
                return false;
            }
            return $this->findMostRecent($candidates);
        }

        private function selectRecentUnstable()
        {
            $candidates = array();
            foreach ($this->versions as $version) {
                if ($this->stable($version) || $this->development($version)) {
                    continue;
                }
                $candidates[] = $version;
            }
            if (empty($candidates)) {
                return false;
            }
            return $this->findMostRecent($candidates);
        }

        private function selectRecentAll()
        {
            $candidates = array();
            foreach ($this->versions as $version) {
                if ($this->development($version)) {
                    continue;
                }
                $candidates[] = $version;
            }
            if (empty($candidates)) {
                return false;
            }
            return $this->findMostRecent($candidates);
        }

        private function findMostRecent(array $candidates)
        {
            $candidate = null;
            $tracker = null;
            foreach ($candidates as $version) {
                if (version_compare($candidate, $version, '<')) {
                    $candidate = $version;
                }
            }
            return $candidate;
        }

        private function stable($version)
        {
            $version = preg_replace('{#.+$}i', '', $version);
            if ($this->development($version)) {
                return false;
            }
            preg_match('{'.$this->modifier.'$}i', strtolower($version), $match);
            if (!empty($match[3])) {
                return false;
            }
            if (!empty($match[1])) {
                if ('beta' === $match[1] || 'b' === $match[1]
                || 'alpha' === $match[1] || 'a' === $match[1]
                || 'rc' === $match[1]) {
                    return false;
                }
            }
            return true;
        }

        private function development($version)
        {
            if ('dev-' === substr($version, 0, 4) || '-dev' === substr($version, -4)) {
                return true;
            }
            if (1 == preg_match("/-\d+-[a-z0-9]{8,}$/", $version)) {
                return true;
            }
            return false;
        }
    }
}

