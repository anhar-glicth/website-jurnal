{**
 * plugins/themes/uiProMax/templates/frontend/pages/submissions.tpl
 *
 * UI Pro Max Theme — Submissions page with Editorial Process Stepper
 *}
{capture assign="submissionChecklistAfterContent"}
	{foreach from=$sections item="section"}
		{if $section->getLocalizedPolicy()}
			<div class="section_policy">
				<h2>{$section->getLocalizedTitle()|escape}</h2>
				{$section->getLocalizedPolicy()}
				{if $isUserLoggedIn}
					{capture assign="sectionSubmissionUrl"}{url page="submission" sectionId=$section->getId()}{/capture}
					<p>
						{translate key="about.onlineSubmissions.submitToSection" name=$section->getLocalizedTitle()|escape url=$sectionSubmissionUrl}
					</p>
				{/if}
			</div>
		{/if}
	{/foreach}
{/capture}

{include file="frontend/components/header.tpl" pageTitle="about.submissions"}

<div class="page page_submissions">
	{include file="frontend/components/breadcrumbs.tpl" currentTitleKey="about.submissions"}
	<h1>
		{translate key="about.submissions"}
	</h1>

	{* ===== EDITORIAL PROCESS STEPPER ===== *}
	<div class="pm_stepper_section pm_reveal">
		<div class="pm_stepper_title">
			<h2>📋 Alur Proses Editorial</h2>
			<p>Berikut adalah tahapan proses penerbitan artikel di jurnal kami</p>
		</div>

		<div class="pm_stepper">
			<div class="pm_step">
				<div class="pm_step_icon">📤</div>
				<div class="pm_step_title">Submission</div>
				<div class="pm_step_desc">Penulis mengirimkan naskah melalui sistem OJS</div>
			</div>

			<div class="pm_step">
				<div class="pm_step_icon">🔍</div>
				<div class="pm_step_title">Peer Review</div>
				<div class="pm_step_desc">Reviewer independen menilai kualitas naskah</div>
			</div>

			<div class="pm_step">
				<div class="pm_step_icon">✏️</div>
				<div class="pm_step_title">Revision</div>
				<div class="pm_step_desc">Penulis melakukan perbaikan berdasarkan masukan</div>
			</div>

			<div class="pm_step">
				<div class="pm_step_icon">📐</div>
				<div class="pm_step_title">Copyediting</div>
				<div class="pm_step_desc">Penyuntingan tata bahasa dan format oleh editor</div>
			</div>

			<div class="pm_step">
				<div class="pm_step_icon">🚀</div>
				<div class="pm_step_title">Publishing</div>
				<div class="pm_step_desc">Artikel diterbitkan secara online dan terindeks</div>
			</div>
		</div>
	</div>
	{* ===== END STEPPER ===== *}

	<div class="pm_submission_actions_wrapper pm_reveal">
		{if $sections|@count == 0 || $currentContext->getData('disableSubmissions')}
			<div class="pm_alert_warning">
				{translate key="author.submit.notAccepting"}
			</div>
		{else}
			{if $isUserLoggedIn}
				<div class="pm_submission_btn_group">
					<a href="{url page="submission"}" class="pm_btn pm_btn_submit_new">
						<span class="pm_btn_icon">📤</span>
						<div class="pm_btn_text">
							<strong>Kirim Naskah Baru</strong>
							<span>Mulai proses pengiriman artikel ilmiah Anda</span>
						</div>
					</a>
					<a href="{url page="submissions"}" class="pm_btn pm_btn_view_existing">
						<span class="pm_btn_icon">📋</span>
						<div class="pm_btn_text">
							<strong>Cek Status Naskah</strong>
							<span>Lihat riwayat dan perkembangan artikel Anda</span>
						</div>
					</a>
				</div>
			{else}
				<div class="pm_submission_btn_group">
					<a href="{url page="login"}" class="pm_btn pm_btn_submit_new pm_trigger_modal">
						<span class="pm_btn_icon">🔑</span>
						<div class="pm_btn_text">
							<strong>Login Penulis</strong>
							<span>Masuk untuk mengirimkan naskah baru</span>
						</div>
					</a>
					<a href="{url page="user" op="register"}" class="pm_btn pm_btn_view_existing pm_trigger_modal">
						<span class="pm_btn_icon">📝</span>
						<div class="pm_btn_text">
							<strong>Daftar Akun Baru</strong>
							<span>Registrasi untuk mendapatkan akses penulis</span>
						</div>
					</a>
				</div>
			{/if}
		{/if}
	</div>

	{if $currentContext->getLocalizedData('authorGuidelines')}
	<div class="author_guidelines pm_reveal" id="authorGuidelines">
		<h2>
			{translate key="about.authorGuidelines"}
			{include file="frontend/components/editLink.tpl" page="management" op="settings" path="workflow" anchor="submission/instructions" sectionTitleKey="about.authorGuidelines"}
		</h2>
		{$currentContext->getLocalizedData('authorGuidelines')}
	</div>
	{/if}

	{if $submissionChecklist}
		<div class="submission_checklist pm_reveal">
			<h2>
				{translate key="about.submissionPreparationChecklist"}
				{include file="frontend/components/editLink.tpl" page="management" op="settings" path="workflow" anchor="submission/instructions" sectionTitleKey="about.submissionPreparationChecklist"}
			</h2>
			{$submissionChecklist}
		</div>
	{/if}

	{if isset($submissionChecklistAfterContent)}
		{$submissionChecklistAfterContent}
	{/if}

	{if $currentContext->getLocalizedData('copyrightNotice')}
		<div class="copyright_notice pm_reveal">
			<h2>
				{translate key="about.copyrightNotice"}
				{include file="frontend/components/editLink.tpl" page="management" op="settings" path="workflow" anchor="submission/instructions" sectionTitleKey="about.copyrightNotice"}
			</h2>
			{$currentContext->getLocalizedData('copyrightNotice')}
		</div>
	{/if}

	{if $currentContext->getLocalizedData('privacyStatement')}
	<div class="privacy_statement pm_reveal" id="privacyStatement">
		<h2>
			{translate key="about.privacyStatement"}
			{include file="frontend/components/editLink.tpl" page="management" op="settings" path="website" anchor="setup/privacy" sectionTitleKey="about.privacyStatement"}
		</h2>
		{$currentContext->getLocalizedData('privacyStatement')}
	</div>
	{/if}

</div><!-- .page -->

{include file="frontend/components/footer.tpl"}
