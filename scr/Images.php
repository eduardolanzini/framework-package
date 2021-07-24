<?php

namespace EduardoLanzini\Framework;

Class Images
{
	private static $errors;

	private static $images;

	public static function save($img,$path, $quality = 95, $width = 1500, $height = 1500){

        self::$errors = null;
        self::$images = null;


        if (isset($_FILES[$img]['name'])) {

            $countfiles = count($_FILES[$img]['name']);

            for($i=0;$i<$countfiles;$i++){

                //CONFERE ERROS
                if($_FILES[$img]['error'][$i] !== 0){

                    //dd($_FILES[$img]['error'][$i]);
                    self::$errors[] = $_FILES[$img]['error'][$i];

                }

                $arquivo_tmp = $_FILES[$img]['tmp_name'][$i];

                $nome = $_FILES[$img]['name'][$i];

                $novoNome = mb_strtolower($nome);

                $ext1 = array(".png", ".jpeg",".jpg", ".gif", ".bmp");
                $ext2 = array(" ", "(",")", "_");

                $novoNome = str_replace($ext1, ".webp", $novoNome);
                $novoNome = str_replace($ext2, "-", $novoNome);


                $info = getimagesize($arquivo_tmp);

                if(strstr('.webp',$ext) && $info['mime'] == 'image/webp'){

                    if (move_uploaded_file($arquivo_tmp, $path.DS.$novoNome)) {
                        self::$images[] = $novoNome;

                        //PULA O LOOP
                        continue;

                    }else{
                        return false;
                    }
                }

                elseif (strstr('.jpg;.jpeg;.gif;.png;.bmp',$ext)) {


                    $info = getimagesize($arquivo_tmp);


                    if ($info[0] > $width || $info[1] > $height) {
                        if($info[0] > $info[1]){

                            $height = ($width/$info[0])*$info[1];
                        } 
                        elseif($info[0] < $info[1]) {
                            $width = ($height/$info[1])*$info[0];
                        }
                    }else{
                        $width = $info[0];
                        $height = $info[1];
                    }

                    /*if ($width_orig > $width || $height_orig > $height) {
                        if($width_orig > $height_orig){
                            $height = ($width/$width_orig)*$height_orig;
                        } 
                        elseif($width_orig < $height_orig) {
                            $width = ($height/$height_orig)*$width_orig;
                        }
                    }else{
                        $width = $width_orig;
                        $height = $height_orig;
                    }*/

                    //dd(exif_imagetype($arquivo_tmp));
                    //dd(getimagesize($arquivo_tmp));
                    //dd($atributo);

                    $novaimagem = imagecreatetruecolor($width,$height);
                    imageAlphaBlending($novaimagem, false);
                    imageSaveAlpha($novaimagem, true);
                    $im = imagecolorallocatealpha($novaimagem, 0, 0, 0, 127);
                    imagefilledrectangle($novaimagem, 0, 0, $width - 1, $height - 1,$im);

                    /*
                    if ($ext == 'jpg' || $ext == 'jpeg') {
                        $origem = imagecreatefromjpeg($arquivo_tmp);
                    }elseif($ext == 'png'){
                        $origem = imagecreatefrompng($arquivo_tmp);
                    }elseif($ext == 'bmp'){
                        $origem = imagecreatefrombmp($arquivo_tmp);
                    }
                    elseif($ext == 'webp'){
                        $origem = imagecreatefromwebp($arquivo_tmp);
                    }
                    else{
                        exit('Formato de imagem não compativel!');
                    }
                    */


                    $novoNome = mb_strtolower($nome);

                    $ext1 = array(".png", ".jpeg",".jpg", ".gif", ".bmp");
                    $ext2 = array(" ", "(",")", "_");

                    $novoNome = str_replace($ext1, ".webp", $novoNome);
                    $novoNome = str_replace($ext2, "-", $novoNome);



                    if ($info['mime'] == 'image/jpeg') {
                        $origem = imagecreatefromjpeg($arquivo_tmp);
                    }elseif($info['mime'] == 'image/png'){
                        $origem = imagecreatefrompng($arquivo_tmp);
                    }elseif($info['mime'] == 'image/bmp'){
                        $origem = imagecreatefrombmp($arquivo_tmp);
                    }

                    else{
                        self::$errors[] = 'Formato de imagem ( '.$ext.' ) inválido! Formatos aceitos: jpg, jpeg, png, webp e bmp.';

                        return false;
                    }
                    
                    imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,$width, 
                        $height, $info[0], $info[1]);

                    //$novoNome = preg_replace('/[^A-Za-z0-9-.]/', '',$nome);
                    //$novoNome = $nome;

                    //$novoNome = remove_acentos($novoNome);


                    if (file_exists($path.DS.$novoNome)) {
                        unlink($path.DS.$novoNome);
                    }

                    if (!imagewebp($novaimagem,$path.DS.$novoNome,$quality)) {

                        self::$errors[] = 'Erro ao renderizar imagem!';
                        return false;
                    }

                    self::$images[] = $novoNome;

                    imagedestroy($novaimagem);
                    
                }
                else{
                    self::$errors[] = 'Formato de imagem ( '.$ext.' ) inválido! Formatos aceitos: jpg, jpeg, png e bmp.';

                    return false;
                }

            }//END FOR

            return true;

        }
        else{

            self::$errors[] = "Imagem não existente!";

            return false;
        }
    }

    public static function getNames()
    {
    	return self::$images;
    }


    public static function getErrors(){

        if (!empty(self::$errors)) {

            foreach(self::$errors as $error){
                $errors .= "<p>{$error}</p><br>";
            }

            return $errors;
        }

        return false;
    ]
}