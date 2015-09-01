<?php
/*

Рисует квадрат

*/

class Square extends Shape
{
 
    /**
     * Проверяет входные параметры квадрата на корректность.
     *
     * $param array $params - параметры квадрата ( x,y - левый нижний угол, side - длина стороны квадрата )
     */ 
    public function set(array $params)
    {
        parent::set($params);
        if ( !isset($params['x']) || !ctype_digit((string) $params['x']) )
        {
            throw new AppException('Координата X должна быть целым числом.');
        }
        if ( !isset($params['y']) || !ctype_digit((string) $params['y']) )
        {
            throw new AppException('Координата Y должна быть целым числом.');
        }
        if ( !isset($params['side']) || !ctype_digit((string) $params['side']) )
        {
            throw new AppException('Длина стороны квадрата должна быть целым числом.');
        }
        if ( $params['x'] > $this->board->getWidth() )
        {
            throw new AppException('Координата X левого нижнего угла квадрата не должна превышать ' . $this->board->getWidth() . '.');
        }
        if ( $params['y'] > $this->board->getHeight() )
        {
            throw new AppException('Координата Y левого нижнего угла квадрата не должна превышать ' . $this->board->getHeight() . '.');
        }
        if ( $params['side'] > max($this->board->getWidth(), $this->board->getHeight()) )
        {
            throw new AppException('Длина стороны квадрата  не должна превышать ' . max($this->board->getWidth(), $this->board->getHeight()) . '.');
        }
        $this->params['x'] = $params['x'];
        $this->params['y'] = $params['y'];
        $this->params['side'] = $params['side'];
    }
 

    /**
     * Рисует квадрат. 
     * Для удобства инверсируем y, чтобы координаты x=0, y=0 соответствовали левому нижниму углу.
     *
     */
    public function draw()
    {
        $x1 = $this->params['x'];
        $y1 = $this->board->getHeight() - $this->params['y'];
        $x2 = $x1 + $this->params['side'];
        $y2 = $y1 - $this->params['side'];
        imagerectangle($this->board->getImage(), $x1, $y1, $x2, $y2, $this->getColor());
    }
    
}