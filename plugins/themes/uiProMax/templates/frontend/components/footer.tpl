{**
 * plugins/themes/uiProMax/templates/frontend/components/footer.tpl
 *
 * UI Pro Max Theme — Premium Footer Override
 * Multi-column layout with branding
 *}

	</div><!-- pkp_structure_main -->

	{* Sidebars *}
	{if empty($isFullWidth)}
		{capture assign="sidebarCode"}{call_hook name="Templates::Common::Sidebar"}{/capture}
		{if $sidebarCode}
			<div class="pkp_structure_sidebar left" role="complementary">
				{* Download Template Banner *}
				<div class="pm_download_banner">
					<div class="pm_dl_icon">📄</div>
					<div class="pm_dl_title">Template Naskah</div>
					<div class="pm_dl_desc">Download template artikel untuk pengajuan naskah Anda</div>
					<a href="{$baseUrl}/public/template_naskah.docx" class="pm_dl_btn" download>
						⬇ Download Template
					</a>
				</div>

				{$sidebarCode}
			</div><!-- pkp_sidebar.left -->
		{/if}
	{/if}
</div><!-- pkp_structure_content -->

{* ===== PREMIUM FOOTER ===== *}
<footer class="pm_footer" role="contentinfo">
	<a id="pkp_content_footer"></a>

	<div class="pm_footer_grid">
		{* Column 1: About *}
		<div class="pm_footer_col">
			<span class="pm_footer_brand" style="display: flex; align-items: center; gap: 8px;">
				<img src="{$baseUrl}/public/logo_pradaya.jpeg" alt="Logo Jurnal Pradaya" style="height: 32px; width: auto; border-radius: 6px;">
				<span>{if $currentContext}{$currentContext->getLocalizedName()|escape}{else}Jurnal Pradaya{/if}</span>
			</span>
			<p>
				Platform publikasi jurnal ilmiah modern dengan standar kualitas internasional.
				Menyediakan akses terbuka untuk penelitian berkualitas tinggi.
			</p>
		</div>

		{* Column 2: Quick Links *}
		<div class="pm_footer_col">
			<h3>Quick Links</h3>
			<ul>
				<li><a href="{url page="index"}">{translate key="navigation.home"}</a></li>
				<li><a href="{url page="issue" op="archive"}">{translate key="navigation.archives"}</a></li>
				<li><a href="{url page="about"}">{translate key="navigation.about"}</a></li>
				<li><a href="{url page="search"}">{translate key="common.search"}</a></li>
			</ul>
		</div>

		{* Column 3: For Authors *}
		<div class="pm_footer_col">
			<h3>Untuk Penulis</h3>
			<ul>
				<li><a href="{url page="about" op="submissions"}">Panduan Pengajuan</a></li>
				{if $isUserLoggedIn}
					<li><a href="{url page="submission"}">Submit Artikel</a></li>
				{else}
					<li><a href="{url page="user" op="register"}">Registrasi</a></li>
				{/if}
				<li><a href="{url page="about" op="editorialTeam"}">Tim Editorial</a></li>
			</ul>
		</div>

		{* Column 4: Contact *}
		<div class="pm_footer_col">
			<h3>Kontak</h3>
			<ul>
				<li>📧 redaksi@jurnalpradaya.id</li>
				<li>📱 +62 812-3456-7890</li>
				<li>📍 Indonesia</li>
			</ul>
		</div>
	</div>

	{* Partner Logos *}
	<div class="pm_footer_partners">
		<a href="https://www.mendeley.com/" target="_blank" rel="noopener noreferrer" title="Mendeley">
			<img src="{$baseUrl}/public/partners/mendeley.jpg" alt="Mendeley" width="120" height="40">
		</a>
		<a href="https://www.turnitin.com/" target="_blank" rel="noopener noreferrer" title="Turnitin">
			<img src="{$baseUrl}/public/partners/turnitin.png" alt="Turnitin" width="120" height="40">
		</a>
		<a href="https://www.grammarly.com/" target="_blank" rel="noopener noreferrer" title="Grammarly">
			<img src="{$baseUrl}/public/partners/grammly.png" alt="Grammarly" width="120" height="40">
		</a>
	</div>

	{* OJS/PKP brand logo (centered) *}
	<div class="pm_footer_ojs_brand pkp_brand_footer">
		<a href="{url page="about" op="aboutThisPublishingSystem"}">
			<img alt="{translate key="about.aboutThisPublishingSystem"}" src="{$baseUrl}/{$brandImage}">
		</a>
	</div>

	{* Footer Bottom *}
	<div class="pm_footer_bottom">
		<p>
			&copy; {$smarty.now|date_format:'Y'}
			{if $currentContext}{$currentContext->getLocalizedName()|escape}{else}Jurnal Pradaya{/if}.
			All rights reserved. |
			Powered by <a href="{url page="about" op="aboutThisPublishingSystem"}">Open Journal Systems</a>
		</p>
	</div>
</footer>
{* ===== END PREMIUM FOOTER ===== *}

</div><!-- pkp_structure_page -->

{load_script context="frontend"}

{call_hook name="Templates::Common::Footer::PageFooter"}

{include file="frontend/components/svg-icon-sprite.blade"}
</body>
</html>
