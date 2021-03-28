<?php

namespace EduardoLanzini\Framework;

Class Image{

	public static $errors = [];
	private static $quality = 80;
	private static $width = 800;
	private static $height = 800;

	public static function save($arrayName,$path)
	{
		if (isset($_FILES[$arrayName]['name'])) {

				//CONFERE ERROS
				if($_FILES[$arrayName]['error'] !== 0){

					dd($_FILES[$arrayName]['error']);
				}

				$arquivo_tmp = $_FILES[$arrayName]['tmp_name'];
				$nome = $_FILES[$arrayName]['name'];

				$extensao = pathinfo($nome, PATHINFO_EXTENSION);

				$ext = strtolower($extensao);

				if (strstr('.jpg;.jpeg;.gif;.png;.bmp;.webp',$extensao)) {

					list($width_orig, $height_orig, $tipo, $atributo) = getimagesize($arquivo_tmp);

					if ($width_orig > self::$width || $height_orig > self::$height) {
						if($width_orig > $height_orig){
							self::$height = (self::$width/$width_orig)*$height_orig;
						} 
						elseif($width_orig < $height_orig) {
							self::$width = (self::$height/$height_orig)*$width_orig;
						}
					}else{
						self::$width = $width_orig;
						self::$height = $height_orig;
					}

					$novaimagem = imagecreatetruecolor(self::$width,self::$height);
					imageAlphaBlending($novaimagem, false);
					imageSaveAlpha($novaimagem, true);
					$im = imagecolorallocatealpha($novaimagem, 0, 0, 0, 127);
					imagefilledrectangle($novaimagem, 0, 0, self::$width - 1, self::$height - 1,$im);

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

					imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,self::$width, 
						self::$height, $width_orig, $height_orig);

					$novoNome = $nome;

					$ext = array(".png", ".jpeg",".jpg", ".gif", ".bmp");

					$novoNome = str_replace($ext, ".webp", $novoNome);

					if (!imagewebp($novaimagem,$path.DIRECTORY_SEPARATOR.$novoNome,self::$quality)) {
						self::$errors[] = 'Erro ao renderizar imagem!';
						return false;
					}
					imagedestroy($novaimagem);
					
				}
				else{
					self::$errors[] = 'Formato de imagem inválido! Formatos aceitos: jpg, jpeg, gif, png e bmp.';

					return false;
				}

			return true;

		}
		else{

			self::$errors[] = "Imagem não existente!";

			return false;
		}
	}
}