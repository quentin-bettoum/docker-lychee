<?php

logMessage("Attempting to upgrade v3 config to v4...");

if (!file_exists("/config/lychee/config.php")) {
    logMessage("No v3 config found at /config/lychee/config.php. Exiting.");
    exit(1);
}

require_once "/config/lychee/config.php";

logMessage("Found v3 config with the following variables:");
logMessage("  dbHost = $dbHost");
logMessage("  dbUser = $dbUser");
logMessage("  dbPassword = $dbPassword");
logMessage("  dbName = $dbName");
logMessage("  dbTablePrefix = $dbTablePrefix");

`sed -i "s|DB_HOST=.*$|DB_HOST=$dbHost|g" /config/.env`;
`sed -i "s|DB_USERNAME=.*$|DB_USERNAME=$dbUser|g" /config/.env`;
`sed -i "s|DB_PASSWORD=.*$|DB_PASSWORD=$dbPassword|g" /config/.env`;
`sed -i "s|DB_DATABASE=.*$|DB_DATABASE=$dbName|g" /config/.env`;
`sed -i "s|DB_OLD_LYCHEE_PREFIX=.*$|DB_OLD_LYCHEE_PREFIX=$dbTablePrefix|g" /config/.env`;

logMessage("Upgrade complete.");

function logMessage($msg)
{
    echo "$msg\n";
}
