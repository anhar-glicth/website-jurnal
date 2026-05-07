<?php

/**
 * @file plugins/themes/ui-pro-max-theme/UiProMaxThemePlugin.php
 *
 * Copyright (c) 2014-2024 Simon Fraser University
 * Copyright (c) 2003-2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class UiProMaxThemePlugin
 * @ingroup plugins_themes_ui_pro_max
 *
 * @brief UI Pro Max theme plugin
 */

namespace APP\plugins\themes\uiProMax;

use PKP\plugins\ThemePlugin;

class UiProMaxThemePlugin extends ThemePlugin
{
    /**
     * @inject
     */
    public function init()
    {
        $this->setParent('default');
        $this->addStyle('ui-pro-max-styles', 'styles/index.css');
        $this->addStyle('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Outfit:wght@400;600;800&display=swap', ['isExternal' => true]);
    }

    /**
     * Get the display name of this plugin
     * @return string
     */
    public function getDisplayName()
    {
        return 'UI/UX Pro Max Theme';
    }

    /**
     * Get the description of this plugin
     * @return string
     */
    public function getDescription()
    {
        return 'A premium, modern theme for OJS with glassmorphism and advanced aesthetics.';
    }
}
