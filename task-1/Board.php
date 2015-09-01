<?php
/**

Класс для создания "доски" для рисования. На которой, впоследствии, рисуются фигуры.

*/

class Board
{
    
    protected $width;
    protected $height;
    protected $image;  // ресурс созданный функцией imagecreatetruecolor
    
    public function __construct($width, $height)
    {
        $this->width  = $width;
        $this->height = $height;
        $this->image  = imagecreatetruecolor($width, $height);
        imagefill($this->image, 1, 1, imagecolorallocate($this->image, 0xFF, 0xFF, 0xFF));
    }
    
    /**
     * Если что-то пошло не так, с помощью этого метода можно отобразить ошибку
     *
     * @param string $text - текст ошибки
     */
    public function error($text)
    {
        $color = imagecolorallocate($this->image, 255, 0, 0);
        imagettftext($this->image, 12, 0, 40, 40, $color, __DIR__ . '/roboto.ttf', $text);
    }

    public function display()
    {
        header('Content-type: image/png');
        imagepng($this->image);
    }
    
    public function getWidth()
    {
        return $this->width;
    }
    
    public function getHeight()
    {
        return $this->height;
    }
    
    public function getImage()
    {
        return $this->image;
    }
    
}