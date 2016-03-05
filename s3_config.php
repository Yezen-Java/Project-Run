<?php

use Aws\S3\S3Client;
$bucket="storage.s3.website.com";
if (!class_exists('S3'))require('s3.php');

			
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJQAUHJ7XGYHTS6AQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

// check whether form was submitted
if ( isset($_GET['uploads']) ) {
   $bucket_name = 'myUploadr';
   $uploads_dir = 'uploads/';
   $refused_types = array('application/exe'); // update this with more options
   $files_arr = array();

   $files = scandir($uploads_dir);
   array_shift($files);
   array_shift($files);
   
   // create a new bucket
   $S3->putBucket($bucket_name, S3::ACL_PUBLIC_READ);

   // filter through, and upload files to s3
   for ( $i = 0; $i < count($files); $i++ ) {
      // make file name unique
      $file_name = time() . '-' . $files[$i];
      $file_path = $uploads_dir . $files[$i];
      
      // check mime types
      $mt = mime_content_type($file_path); // image/jpg

      if ( in_array($mt, $refused_types) ) {
         // can't accept the file. Delete it.
         unlink($file_path);
         continue;
      }

      // upload file to S3
      // path to file we want to move, bucket name, desired file name, acl
      if ( $S3->putObjectFile($file_path, $bucket_name, $file_name, S3::ACL_PUBLIC_READ) ) {
         // delete the file from uploads folder
         unlink($file_path);
         
         // update files array
         $files_arr[$files[$i]] = "http://$bucket_name.s3.amazonaws.com/$file_name";
      }
   }
}

include 'index.php';

?>