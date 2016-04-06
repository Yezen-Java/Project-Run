<?php

use Aws\S3\S3Client;
$bucket="hive.storage";
if (!class_exists('S3'))require('s3.php');

			
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJBRJTSIXZGEMTSXQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);


?>