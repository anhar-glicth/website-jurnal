<?php

/**
 * One-time setup: Jurnal Paradaya settings + uiProMax theme.
 * Run: php tools/setup-journal-paradaya.php
 */

define('INDEX_FILE_LOCATION', dirname(__FILE__) . '/../index.php');
require dirname(__FILE__) . '/../lib/pkp/includes/bootstrap.php';

use APP\facades\Repo;
use PKP\plugins\PluginRegistry;

$journal = Repo::context()->get(1);
if (!$journal) {
    fwrite(STDERR, "Journal ID 1 not found.\n");
    exit(1);
}

$settings = [
    'contactEmail' => 'jurnal.paradaya@example.com',
    'contactName' => 'Muhammad Anhar Solihin',
    'publisherInstitution' => 'Jurnal Paradaya',
    'publisherUrl' => 'http://localhost/ojs/index.php/jid',
    'licenseUrl' => 'https://creativecommons.org/licenses/by/4.0/',
    'copyrightHolderType' => 'context',
    'country' => 'ID',
    'publishingMode' => 1,
    'itemsPerPage' => 25,
    'numPageLinks' => 10,
    'enableOai' => true,
    'doiPrefix' => '10.00000',
    'doiSuffixType' => 'default',
    'enabledDoiTypes' => ['publication'],
    'themePluginPath' => 'uiProMax',
    'copySubmissionAckPrimaryContact' => true,
];

$localized = [
    'en' => [
        'description' => '<p><em>Jurnal Paradaya</em> is an open-access scientific journal publishing peer-reviewed research.</p>',
        'about' => '<p><strong>Jurnal Paradaya</strong> provides a platform for researchers to publish original articles and reviews.</p>',
        'privacyStatement' => '<p>We collect personal data only for journal operations. Data is not sold to third parties.</p>',
        'copyrightNotice' => '<p>Copyright &copy; {$copyrightYear} by the author(s). Licensed under CC BY 4.0.</p>',
        'submissionChecklist' => '<ul><li>The submission has not been previously published elsewhere.</li><li>The manuscript is in Word or PDF format.</li><li>References include DOIs where available.</li></ul>',
        'authorGuidelines' => '<p>Prepare manuscripts per journal template. Include abstract (max 250 words) and 3–6 keywords.</p>',
    ],
    'id' => [
        'description' => '<p><em>Jurnal Paradaya</em> adalah jurnal ilmiah akses terbuka dengan proses peer review.</p>',
        'about' => '<p><strong>Jurnal Paradaya</strong> menyediakan platform publikasi artikel penelitian asli dan tinjauan.</p>',
        'privacyStatement' => '<p>Kami mengumpulkan data pribadi hanya untuk operasional jurnal.</p>',
        'copyrightNotice' => '<p>Hak cipta &copy; {$copyrightYear} penulis. Berlisensi CC BY 4.0.</p>',
        'submissionChecklist' => '<ul><li>Naskah belum pernah diterbitkan di jurnal lain.</li><li>File dalam format Word atau PDF.</li><li>Referensi memuat DOI jika tersedia.</li></ul>',
        'authorGuidelines' => '<p>Siapkan naskah sesuai template. Sertakan abstrak (maks. 250 kata) dan 3–6 kata kunci.</p>',
    ],
];

foreach ($settings as $key => $value) {
    $journal->setData($key, $value);
}

foreach ($localized as $locale => $fields) {
    foreach ($fields as $key => $value) {
        $journal->setData($key, $value, $locale);
    }
}

Repo::context()->edit($journal, []);

// Enable plugins
$plugins = [
    ['generic', 'crossref'],
    ['generic', 'googleAnalytics'],
    ['themes', 'uiProMax'],
    ['generic', 'premiumCss'],
];

foreach ($plugins as [$category, $name]) {
    $plugin = PluginRegistry::getPlugin($category, $name);
    if ($plugin) {
        $plugin->setEnabled(true, $journal->getId());
    }
}

$crossref = PluginRegistry::getPlugin('generic', 'crossref');
if ($crossref) {
    $crossref->updateSetting($journal->getId(), 'depositorName', 'Jurnal Paradaya', 'string');
    $crossref->updateSetting($journal->getId(), 'depositorEmail', 'jurnal.paradaya@example.com', 'string');
    $crossref->updateSetting($journal->getId(), 'testMode', true, 'bool');
}

echo "OK: Jurnal Paradaya configured (theme: uiProMax).\n";
echo "Update contactEmail and Crossref credentials in the admin panel.\n";
