<?php
/*

Абстрактный класс для всех фигур. Реализует базовый функционал

*/


abstract class Shape
{

    protected $board;
    protected $params = array();
    
    /**
     * Метод рисует изображение
     *
     */
    abstract public function draw();
    
    
    public function __construct(Board $board)
    {
        $this->board = $board;
    }
    
    
    protected function getColor()
    {
        preg_match("/^(.{2})(.{2})(.{2})$/", $this->params['color'], $out);
        return imagecolorallocate($this->board->getImage(), hexdec($out[1]), hexdec($out[2]), hexdec($out[3]));
    }
    
    
    /**
     * Проверяет входные параметры на корректность.
     * Здесь только проверка цвета, остальное в конкретных классах фигур.
     *
     * $param array $params - параметры фигуры
     */
    public function set(array $params)
    {
        if ( isset($params['color']) )
        {
            if ( !preg_match('/^\#?([0-9A-Fa-f]{6})$/', $params['color'], $out) )
            {
                throw new AppException('Координаты цвета содержат неправильное значение.');
            }
            $this->params['color'] = $out[1];
        }
        else
        {
            $this->params['color'] = '000000';
        }
    }
    
    
}