<?php
/**
 * filename
 * extension
 * mimetype
 * size
 * dimension
 */
class FileInfo {

    const PERIOD = ".";

    /** 
     * @method filename e extension
     * @var $file_name
     * nos @method a @var pode tanto ser a imagem por diretorio, url ou só o nome do arquivo*/

    static function filename($file_name, $with_ext = true) {
        if($with_ext == false)
            return pathinfo($file_name, PATHINFO_FILENAME);
        else
            return basename($file_name);
    }

    static function extension($file_name, $period = false) {
        if($period == true)
            return self::PERIOD.pathinfo($file_name, PATHINFO_EXTENSION);
        else
            return pathinfo($file_name, PATHINFO_EXTENSION);
    }

    /**
     * @link https://www.php.net/manual/pt_BR/function.finfo-open.php 
     * */
    static function mimetype($file_dir) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        return $finfo->file($file_dir);
        /** procedural:
         * $finfo = finfo_open(FILEINFO_MIME_TYPE);
         * return finfo_file($finfo, $file_dir);
         * finfo_close($finfo); */
    }

    static function size($file_dir) {
        $size = filesize($file_dir);
        $units = array('B', 'KB', 'MB');
        $power = (($size > 0) ? log($size, 1024) : 0);
        $proportion = number_format($size / pow(1024, $power), 2, ',', '.');
        return round($proportion).' '.$units[$power];
    }

    static function dimension($file_url) {
        $width = number_format(getimagesize($file_url)[0], 0, '.', '.');
        $height = number_format(getimagesize($file_url)[1], 0, '.', '.');
        if($width != 0 && $height != 0)
            return $width.' &times; '.$height;
    }

}