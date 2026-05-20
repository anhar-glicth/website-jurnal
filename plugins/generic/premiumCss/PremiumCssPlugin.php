<?php

/**
 * @file plugins/generic/premiumCss/PremiumCssPlugin.php
 *
 * Legacy CSS injector — styles are loaded by the UI Pro Max theme.
 * This plugin remains enabled for compatibility but does not inject duplicates.
 */

namespace APP\plugins\generic\premiumCss;

use PKP\plugins\GenericPlugin;

class PremiumCssPlugin extends GenericPlugin
{
    public function register($category, $path, $mainContextId = null)
    {
        return parent::register($category, $path, $mainContextId);
    }

    public function getDisplayName()
    {
        return 'Premium CSS (legacy)';
    }

    public function getDescription()
    {
        return 'Styles are provided by the UI/UX Pro Max theme. Keep enabled for version tracking only.';
    }
}
