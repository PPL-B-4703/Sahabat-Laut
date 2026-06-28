<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Prepare for Dusk test execution.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        if (! static::runningInSail()) {
            static::startChromeDriver(['--port=9515']);
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     */
    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments(collect([
            $this->shouldStartMaximized() ? '--start-maximized' : '--window-size=1920,1080',
            '--disable-search-engine-choice-screen',
            '--disable-smooth-scrolling',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--remote-allow-origins=*',
            '--disable-gpu', // Taruh di sini agar selalu aktif
            '--disable-software-rasterizer', // Opsional: bantu meredam error video/gl device lainnya
        ])->unless($this->hasHeadlessDisabled(), function (Collection $items) {
            return $items->merge([
                '--headless=new',
            ]);
        })->all());

        $chromeBinary = static::resolveChromeBinary();
        if ($chromeBinary) {
            $options->setBinary($chromeBinary);
        }

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? env('DUSK_DRIVER_URL') ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    protected static function resolveChromeBinary(): ?string
    {
        $candidates = array_filter([
            getenv('CHROME_BIN'),
            getenv('DUSK_CHROME_BINARY'),
            'C:\Program Files\Google\Chrome\Application\chrome.exe',
            'C:\Program Files (x86)\Google\Chrome\Application\chrome.exe',
            'C:\Program Files\Chromium\Application\chrome.exe',
        ]);

        foreach ($candidates as $candidate) {
            if (is_string($candidate) && file_exists($candidate)) {
                return $candidate;
            }
        }

        $output = [];
        @exec('where.exe chrome 2>nul', $output, $exitCode);

        if ($exitCode === 0) {
            foreach ($output as $line) {
                $line = trim($line);
                if ($line !== '' && str_contains($line, 'chrome.exe')) {
                    return $line;
                }
            }
        }

        return null;
    }
}
