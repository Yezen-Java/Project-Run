<?php
// Bucket Name
$bucket="storage.s3.website.com";
if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAI7EBQYIK4VC7L7VA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

$s3 = new S3(awsAccessKey, awsSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
?>