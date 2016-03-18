<?php

use Aws\S3\S3Client;
$bucket="hive.testing.storage";
if (!class_exists('S3'))require('s3.php');

			
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJQAUHJ7XGYHTS6AQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);


?>