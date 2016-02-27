<?php

# Include the Dropbox SDK libraries
require_once "dropbox-sdk/lib/Dropbox/autoload.php";
use \Dropbox as dbx;

$appInfo = dbx\AppInfo::loadFromJsonFile("StroageConfig.json");
$webAuth = new dbx\WebAuthNoRedirect($appInfo,"storageApp/1.0");

$authorizeUrl = $webAuth->start();

echo "1. Go to: " . $authorizeUrl . "\n";
echo "2. Click \"Allow\" (you might have to log in first).\n";
echo "3. Copy the authorization code.\n";
$authCode = \trim(\readline("oVh76x8K9jAAAAAAAAAACqvjS6htIDGTrx4xdsu7raKN142f6FWTLnK0Vfs3FgiM"));

list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
print "Access Token: " . $accessToken . "\n";

$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
$accountInfo = $dbxClient->getAccountInfo();

print_r($accountInfo);

$f = fopen("media/sample_iPod.m4v", "rb");
$result = $dbxClient->uploadFile("/media/sample_iPod.m4v", dbx\WriteMode::add(), $f);
fclose($f);
print_r($result);

$folderMetadata = $dbxClient->getMetadataWithChildren("/");
print_r($folderMetadata);

$f = fopen("working-draft.txt", "w+b");
$fileMetadata = $dbxClient->getFile("/working-draft.txt", $f);
fclose($f);
print_r($fileMetadata);

?>