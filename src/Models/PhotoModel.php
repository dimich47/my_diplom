<?php


namespace Ifmo\Web\Models;


class PhotoModel
{
    static public function savePhoto($files,  $key)
    {
        $file_name = $files[$key]['name'];

        //расширение файла
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        //  Необходимо изменять имя файла
        $name = md5($file_name); // + data
        $full_name = $name . '.' . $ext;

        //  проверить размер
        //  проверять тип

        //перемещения файла из временной папки
        // move_uploaded_file(временная папка, куда перемещаем);
        $tmp_name = $files[$key]['tmp_name'];
        move_uploaded_file($tmp_name, "static/img/$full_name");
        return $full_name;
    }
    static public function savePhotos($files,  $key)
    {
        $file_name = $files['photoSlider']['name'][$key];

        //расширение файла
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        //  Необходимо изменять имя файла
        $name = md5($file_name); // + data
        $full_name = $name . '.' . $ext;

        //  проверить размер
        //  проверять тип

        //перемещения файла из временной папки
        // move_uploaded_file(временная папка, куда перемещаем);
        $tmp_name = $files[photoSlider]['tmp_name'][$key];
        move_uploaded_file($tmp_name, "static/img/$full_name");
        return $full_name;
    }
}