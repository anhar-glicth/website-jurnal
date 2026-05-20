<?php

/**
 * UI Pro Max Theme Plugin — OJS 3.4
 *
 * Standalone premium theme with glassmorphism design.
 * Loads Google Fonts, premium CSS, and interactive JS.
 * Template overrides in templates/ directory.
 */

namespace APP\plugins\themes\uiProMax;

use PKP\plugins\ThemePlugin;

class UiProMaxThemePlugin extends ThemePlugin
{
    public function init()
    {
        // ---- Google Fonts ----
        $this->addStyle(
            'google-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700;800&display=swap',
            ['baseUrl' => '']
        );

        // ---- Master CSS ----
        $this->addStyle(
            'ui-pro-max-styles',
            'styles/index.css'
        );

        // ---- Premium JavaScript ----
        $this->addScript(
            'ui-pro-max-js',
            'js/premium.js'
        );

        // ---- Register menu areas ----
        $this->addMenuArea(['primary', 'user']);
    }

    /**
     * Get the display name of this plugin.
     */
    public function getDisplayName()
    {
        return 'UI/UX Pro Max Theme';
    }

    /**
     * Get the description of this plugin.
     */
    public function getDescription()
    {
        return 'A premium, modern theme for OJS with glassmorphism aesthetics, dark mode, animated counters, editorial stepper, and responsive design.';
    }
}
