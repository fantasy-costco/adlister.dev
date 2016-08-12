<?php
if(isset($_FILES['UploadFileField'])){

  $UploadName = $_FILES['UploadFileField']['name'];
  $UploadName = mt_rand(100000, 999999).$UploadName;
  $UploadTmp = $_FILES['UploadFileField']['tmp_name'];
  $UploadType = $_FILES['UploadFileField']['type'];
  $FileSize = $_FILES['UploadFileField']['size'];

  $UploadName = preg_replace("#[^a-z0-9.]#i", "", $UploadName);

  if(($FileSize > 50000)){
    die('Error - File too big.');
  }

  if(!$UploadTmp) {
    die("No File Selected. Please upload a file.");
  } else {

    //Must first figure out where the directory path should be for
    //when uploading files. All uploaded images should be placed in
    //  /img directory.

    move_uploaded_file($UploadTmp, "/img/$UploadName");

  }

}
