{**
 * plugins/themes/uiProMax/templates/frontend/components/headerHead.tpl
 *
 * Premium theme override — Clean <head> with SEO meta tags.
 * Font & CSS loading handled by UiProMaxThemePlugin.php
 *}
<head>
	<meta charset="{$defaultCharset|escape}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{if $currentContext}{$currentContext->getLocalizedData('description')|strip_tags|truncate:160}{else}Jurnal Pradaya — Platform publikasi jurnal ilmiah modern{/if}">
	<meta name="theme-color" content="#6366f1">
	<title>
		{$pageTitleTranslated|strip_tags}
		{if $requestedPage|escape|default:"index" != 'index' && $currentContext && $currentContext->getLocalizedName()}
			| {$currentContext->getLocalizedName()}
		{/if}
	</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	{load_header context="frontend"}
	{load_stylesheet context="frontend"}

	{* Dark mode: apply saved theme before render to prevent flash *}
	<script>
		(function() {
			var t = localStorage.getItem('pm_theme');
			if (t === 'dark') document.documentElement.setAttribute('data-theme', 'dark');
			else if (!t && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
				document.documentElement.setAttribute('data-theme', 'dark');
		})();
	</script>
</head>
