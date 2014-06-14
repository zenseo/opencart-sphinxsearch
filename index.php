<?php

require_once($vqmod->modCheck(DIR_SYSTEM . 'library/sphinxapi.php'));

// Sphinx API
$sphinx = new SphinxClient();
$sphinx->SetServer(SPH_SERVER, SPH_PORT);
$sphinx->SetMatchMode(SPH_MATCH_MODE);
$sphinx->SetLimits(SPH_LIMITS_START, SPH_LIMITS_LIMIT, SPH_LIMITS_MAX_MATCHES);
$registry->set('sphinx', $sphinx);
