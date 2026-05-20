{**
 * plugins/themes/uiProMax/templates/frontend/components/header.tpl
 *
 * UI Pro Max Theme — Premium Header Override
 * Glassmorphism navigation, dark mode toggle, tabbed modal login/register
 *}
{strip}
	{assign var="showingLogo" value=true}
	{if !$displayPageHeaderLogo}
		{assign var="showingLogo" value=false}
	{/if}
{/strip}
<!DOCTYPE html>
<html lang="{$currentLocale|replace:"_":"-"}" xml:lang="{$currentLocale|replace:"_":"-"}">
{if !$pageTitleTranslated}{capture assign="pageTitleTranslated"}{translate key=$pageTitle}{/capture}{/if}
{include file="frontend/components/headerHead.tpl"}
<body class="pkp_page_{$requestedPage|escape|default:"index"} pkp_op_{$requestedOp|escape|default:"index"}{if $showingLogo} has_site_logo{/if}" dir="{$currentLocaleLangDir|escape|default:"ltr"}">
	<script>
		if (window.self !== window.top) {
			document.body.classList.add('is_in_iframe');
		}
	</script>

	{* Reading Progress Bar *}
	<div id="readingProgressBar" class="pm_reading_progress" style="display:none;"></div>

	<div class="pkp_structure_page">

		{* ===== PREMIUM HEADER BAR ===== *}
		<header class="pkp_structure_head premium_header_bar" role="banner">
			<div class="premium_header_container">

				{* 1. Site Branding *}
				<div class="premium_site_branding">
					{capture assign="homeUrl"}{url page="index" router=PKP\core\PKPApplication::ROUTE_PAGE}{/capture}
					{if $displayPageHeaderLogo}
						<a href="{$homeUrl}" class="premium_logo_img">
							<img src="{$publicFilesDir}/{$displayPageHeaderLogo.uploadName|escape:"url"}"
								 {if $displayPageHeaderLogo.altText}alt="{$displayPageHeaderLogo.altText|escape}"{else}alt="{$displayPageHeaderTitle|escape}"{/if}>
						</a>
					{/if}
					<a href="{$homeUrl}" class="premium_logo_text">
						<img src="{$baseUrl}/public/logo_pradaya.jpeg" alt="Logo Jurnal Pradaya" class="premium_logo_icon">
						<span>{if $displayPageHeaderTitle}{$displayPageHeaderTitle|escape}{else}{if $currentContext}{$currentContext->getLocalizedName()|escape}{else}Jurnal Pradaya{/if}{/if}</span>
					</a>
				</div>

				{* 2. Primary Navigation *}
				<nav class="premium_nav_primary" aria-label="Primary Navigation">
					<ul>
						<li><a href="{url page="index"}">{translate key="navigation.home"}</a></li>
						<li><a href="{url page="about" op="submissions"}">Kirim Naskah</a></li>
						<li><a href="{url page="issue" op="archive"}">{translate key="navigation.archives"}</a></li>
						<li><a href="{url page="about"}">{translate key="navigation.about"}</a></li>
						{if $currentContext && $requestedPage !== 'search'}
							<li><a href="{url page="search"}">🔍 {translate key="common.search"}</a></li>
						{/if}
					</ul>
				</nav>

				{* 3. Right side: Dark mode toggle + User nav *}
				<div class="premium_header_right">
					{* Dark Mode Toggle *}
					<button id="darkModeToggle" class="pm_dark_toggle" aria-label="Toggle dark mode" title="Toggle Dark Mode">
						<span class="pm_icon_sun">☀️</span>
						<span class="pm_icon_moon">🌙</span>
					</button>

					{* User Navigation *}
					<div class="premium_nav_user">
						<ul>
							{if $isUserLoggedIn}
								<li><a href="{url page="dashboard"}" class="btn_dashboard">Dashboard</a></li>
								<li><a href="{url page="login" op="signOut"}" class="btn_logout">Logout</a></li>
							{else}
								<li><a href="{url page="login"}" class="btn_login pm_trigger_modal">Login</a></li>
								<li><a href="{url page="user" op="register"}" class="btn_register pm_trigger_modal">Register</a></li>
							{/if}
						</ul>
					</div>
				</div>

			</div>
		</header>
		{* ===== END PREMIUM HEADER BAR ===== *}

		{* ===== TABBED MODAL LOGIN/REGISTER ===== *}
		<div id="pmModalOverlay" class="pm_modal_overlay"
			 data-login-url="{url page="login"}"
			 data-register-url="{url page="user" op="register"}">
			<div class="pm_modal_container">
				<button id="pmModalClose" class="pm_modal_close" aria-label="Close">&times;</button>

				<div class="pm_modal_tabs">
					<div id="pmTabLogin" class="pm_modal_tab active">Login</div>
					<div id="pmTabRegister" class="pm_modal_tab">Register</div>
				</div>

				<iframe id="pmModalIframe" class="pm_modal_iframe" src="about:blank" title="Login / Register"></iframe>
			</div>
		</div>
		{* ===== END MODAL ===== *}

		{* ===== WHATSAPP FLOATING WIDGET ===== *}
		<div id="waWidget" class="pm_wa_widget">
			<div class="pm_wa_tooltip">Ada pertanyaan? Chat Kami 💬</div>
			<a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="pm_wa_btn" aria-label="Chat WhatsApp">
				<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
				</svg>
			</a>
		</div>
		{* ===== END WHATSAPP ===== *}

		<div class="pkp_structure_content{if $hasSidebar} has_sidebar{/if}">
			<div class="pkp_structure_main" role="main">
				<a id="pkp_content_main"></a>
