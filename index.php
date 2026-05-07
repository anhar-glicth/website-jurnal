<?php

/**
 * @file index.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup index
 *
 * @brief Front-end for the OJS application. Provides a point of entry for
 * all requests.
 *
 */

define('INDEX_FILE_LOCATION', __FILE__);

require './lib/pkp/includes/bootstrap.php';

// Initialize the application and execute
APP\core\Application::get()->execute();
