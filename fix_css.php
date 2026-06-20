<?php
$css = "
/* Fix Dropdown Text Color */
.pkpDropdown__menu a,
.pkpDropdown__menu button,
.pkpDropdown__action,
.app__headerAction .dropdown-menu a,
.app__headerAction .dropdown-menu button,
.dropdown-menu > li > a,
.dropdown-menu > li > button,
.pkpDropdown__section a,
.pkpDropdown__section button {
    color: #222 !important;
    opacity: 1 !important;
    visibility: visible !important;
}
";

$file = '/home/u609332033/domains/journalpradaya.com/public_html/styles/build.css';
file_put_contents($file, $css, FILE_APPEND);
echo "Appended CSS to build.css\n";
