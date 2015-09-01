<?php
/*

Рисует круг

*/

class Circle extends Shape
{
 
    /**
     * Проверяет входные параметры круга на корректность.
     *
     * $param array $params - параметры круга ( x,y - центр окружности, radius - радиус )
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
        if ( !isset($params['radius']) || !ctype_digit((string) $params['radius']) )
        {
            throw new AppException('Радиус окружности должен быть целым числом.');
        }
        if ( $params['x'] > $this->board->getWidth() )
        {
            throw new AppException('Центр окружности не должен превышать ' . $this->board->getWidth() . ' по оси X.');
        }
        if ( $params['y'] > $this->board->getHeight() )
        {
            throw new AppException('Центр окружности не должен превышать ' . $this->board->getHeight() . ' по оси Y.');
        }
        if ( $params['radius'] > max($this->board->getWidth(), $this->board->getHeight()) )
        {
            throw new AppException('Радиус окружности не должен превышать ' . max($this->board->getWidth(), $this->board->getHeight()) . '.');
        }
        $this->params['x'] = $params['x'];
        $this->params['y'] = $params['y'];
        $this->params['radius'] = $params['radius'];
    }
 
 
    /**
     * Рисует круг. 
     * Для удобства инверсируем y, чтобы координаты x=0, y=0 соответствовали левому нижниму углу.
     *
     */
    public function draw()
    {
        $x = $this->params['x'];
        $y = $this->board->getHeight() - $this->params['y'];
        $d = $this->params['radius'] * 2;
        imageellipse($this->board->getImage(), $x, $y, $d, $d, $this->getColor());
    }
    
}