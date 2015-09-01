<?php
/*

Для создания "доски" для рисования и, собственно, рисования на ней фигур я использовал
паттерн Builder.

*/

class Builder
{

    const BOARD_WIDTH  = 800;
    const BOARD_HEIGHT = 600;
    
    protected $board;
    
    
    public function createBoard()
    {
        $this->board = new Board(self::BOARD_WIDTH, self::BOARD_HEIGHT);
    }
    
    public function getBoard()
    {
        return $this->board;
    }
    
    /**
     * Рисует фигуры на "доске" для рисования.
     *
     * @param array $shapes - параметры всех фигур в том виде, в котором они даны в задании
     *
     */
    public function drawShapes(array $shapes)
    {
        try
        {
            foreach ( $shapes as $shape )
            {
                switch ( $shape['type'] )
                {
                    case 'circle':
                    {
                        $object = new Circle($this->board);
                        break;
                    }
                    case 'square':
                    {
                        $object = new Square($this->board);
                        break;
                    }
                    default:
                    {
                        throw new AppExtension("Нет класса чтобы нарисовать {$shapes['type']}.");
                    }
                }
                $object->set($shape['params']);
                $object->draw();
            }
        }
        catch (AppException $ex)
        {
            $this->board->error($ex->getMessage());
        }
    }
    
}