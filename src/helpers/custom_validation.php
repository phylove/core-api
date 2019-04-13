<?php


/**
 * 
 * Image Validation from base64
 * 
 */

Validator::extend('is_image',function($attribute, $value, $params, $validator) {
    $image = base64_decode($value);
    $f = finfo_open();
    $result = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
    return ($result == 'image/png' || $result == 'image/jpeg' || $result == 'image/jpg');
});