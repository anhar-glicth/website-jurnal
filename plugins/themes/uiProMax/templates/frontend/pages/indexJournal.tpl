{**
 * plugins/themes/uiProMax/templates/frontend/pages/indexJournal.tpl
 *
 * UI Pro Max Theme — Premium Journal Index Page
 * Includes: Hero section, Counter Stats, Indexing Badges, Latest Articles
 *}
{include file="frontend/components/header.tpl" pageTitleTranslated=$currentJournal->getLocalizedName()}

<div class="page_index_journal">

	{call_hook name="Templates::Index::journal"}

	{* ===== HERO SECTION ===== *}
	<section class="pm_hero pm_reveal">
		<div class="pm_hero_content">
			<span class="pm_hero_badge">📚 Open Access Journal</span>
			<h1>{$currentJournal->getLocalizedName()|escape}</h1>
			<p class="pm_hero_subtitle">
				{if $journalDescription}
					{$journalDescription|strip_tags|truncate:180}
				{else}
					Platform publikasi jurnal ilmiah modern dengan standar peer-review internasional. Menyediakan akses terbuka untuk penelitian berkualitas tinggi.
				{/if}
			</p>
			<div class="pm_hero_cta">
				<a href="{url page="about" op="submissions"}" class="pm_btn_hero_submit">
					<span>Kirim Naskah Baru</span>
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
				</a>
			</div>
		</div>
	</section>
	{* ===== END HERO ===== *}

	{* ===== COUNTER STATS ===== *}
	<section class="pm_stats_section pm_reveal">
		<div class="pm_stat_card">
			<span class="pm_stat_icon">📝</span>
			<div class="pm_stat_number" data-target="{if $publishedPublications}{$publishedPublications->count()}{else}0{/if}">0</div>
			<div class="pm_stat_label">Artikel Terbit</div>
		</div>
		<div class="pm_stat_card">
			<span class="pm_stat_icon">📖</span>
			<div class="pm_stat_number" data-target="{if $issue}1{else}0{/if}">0</div>
			<div class="pm_stat_label">Issue Aktif</div>
		</div>
		<div class="pm_stat_card">
			<span class="pm_stat_icon">👨‍🔬</span>
			<div class="pm_stat_number" data-target="25">0</div>
			<div class="pm_stat_label">Kontributor</div>
		</div>
		<div class="pm_stat_card">
			<span class="pm_stat_icon">🌍</span>
			<div class="pm_stat_number" data-target="100">0</div>
			<div class="pm_stat_label">Pembaca</div>
		</div>
	</section>
	{* ===== END COUNTER STATS ===== *}

	{if $highlights && $highlights->count()}
		{include file="frontend/components/highlights.tpl" highlights=$highlights}
	{/if}

	{if $activeTheme && !$activeTheme->getOption('useHomepageImageAsHeader') && $homepageImage}
		<div class="homepage_image">
			<img src="{$publicFilesDir}/{$homepageImage.uploadName|escape:"url"}"{if $homepageImage.altText} alt="{$homepageImage.altText|escape}"{/if}>
		</div>
	{/if}

	{if $categories && $categories->count() > 0}
		{include file="frontend/components/categoryHeader.tpl" categories=$categories}
	{/if}

	{* Journal Description *}
	{if $activeTheme && $activeTheme->getOption('showDescriptionInJournalIndex')}
		<section class="homepage_about pm_reveal">
			<a id="homepageAbout"></a>
			<h2>{translate key="about.aboutContext"}</h2>
			{$currentContext->getLocalizedData('description')}
		</section>
	{/if}

	{include file="frontend/objects/announcements_list.tpl" numAnnouncements=$numAnnouncementsHomepage}

	{* Latest Published Publications *}
	{if $publishedPublications && $publishedPublications->count()}
		<section class="pm_reveal">
			{include file="frontend/objects/latest_article.tpl" articles=$publishedPublications heading="h2"}
		</section>
	{/if}

	{* Current Issue *}
	{if $issue}
		<section class="current_issue pm_reveal">
			<a id="homepageIssue"></a>
			<h2>
				{translate key="journal.currentIssue"}
			</h2>
			<div class="current_issue_title">
				{$issue->getIssueIdentification()|escape}
			</div>
			{include file="frontend/objects/issue_toc.tpl" heading="h3"}
			<a href="{url router=PKP\core\PKPApplication::ROUTE_PAGE page="issue" op="archive"}" class="read_more">
				{translate key="journal.viewAllIssues"}
			</a>
		</section>
	{/if}

	{* ===== INDEXING BADGES ===== *}
	<section class="pm_indexing_section pm_reveal">
		<h2>🏛️ Terindeks Di</h2>
		<p class="pm_indexing_subtitle">Jurnal kami terindeks di berbagai database ilmiah internasional</p>
		<div class="pm_indexing_grid">
			<div class="pm_indexing_badge" title="Google Scholar">
				<span>Google<br>Scholar</span>
			</div>
			<div class="pm_indexing_badge" title="DOAJ">
				<span>DOAJ</span>
			</div>
			<div class="pm_indexing_badge" title="Crossref">
				<span>Crossref</span>
			</div>
			<div class="pm_indexing_badge" title="SINTA">
				<span>SINTA</span>
			</div>
			<div class="pm_indexing_badge" title="Garuda">
				<span>Garuda<br>Kemdikbud</span>
			</div>
			<div class="pm_indexing_badge" title="Dimensions">
				<span>Dimensions</span>
			</div>
		</div>
	</section>
	{* ===== END INDEXING BADGES ===== *}

	{* Additional Homepage Content *}
	{if $additionalHomeContent}
		<div class="additional_content pm_reveal">
			{$additionalHomeContent}
		</div>
	{/if}
</div><!-- .page_index_journal -->

{include file="frontend/components/footer.tpl"}
