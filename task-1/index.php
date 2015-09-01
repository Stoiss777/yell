<?php

$shapes = '';

if ( !empty($_POST) ) 
{
    
    $res = array();
    for ( $i=1; $i<count($_POST['type']); $i++ )
    {
        $res[$i-1] = array
        (
            'type' => $_POST['type'][$i],
            'params' => array
            (
                'color' => $_POST['color'][$i],
                'x' => $_POST['x'][$i],
                'y' => $_POST['y'][$i],
                'r' => $_POST['y'][$i]
            )
        );
        if ( $_POST['type'][$i] == 'circle' )
        {
            $res[$i-1]['params']['radius'] = $_POST['r'][$i];
        }
        else if  ( $_POST['type'][$i] == 'square' )
        {
            $res[$i-1]['params']['side'] = $_POST['r'][$i];
        }
    }
    if ( $res ) 
    {
        $shapes = urlencode(serialize($res));
    }
    
}

?><!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Задание 1</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:italic,regular,bold" />
    <style>
        html
        {
            font: 12pt Roboto, arial, sans-serif;
        }
        label
        {
            margin-left: 20px;
        }
        input[type=button]
        {
            margin: 20px;
        }
    </style>
    <script>
    
        function addShape(type, color, x, y, r)
        {
            var ne = document.getElementById("template").cloneNode(true);
            ne.id = "";
            ne.style.display = "block";
            var tp = ne.getElementsByClassName("type")[0];
            for ( var i=0; i<tp.length; i++ )
            {
                if ( tp[i].value == type ) 
                {
                    tp.selectedIndex = i;
                    break;
                }   
            }
            ne.getElementsByClassName("color")[0].value = color;
            ne.getElementsByClassName("x")[0].value = x;
            ne.getElementsByClassName("y")[0].value = y;
            ne.getElementsByClassName("r")[0].value = r;
            document.getElementById("container").appendChild(ne);
        }
        
        function loadAll()
        {
            <?php if ( empty($res) ): ?>
                addShape("circle", "#000000", 0, 0, 0);
            <?php else: ?>
                <?php foreach ( $res as $v ): ?>
                    addShape("<?=$v['type']?>", "<?=$v['params']['color']?>", <?=$v['params']['x']?>, <?=$v['params']['y']?>, <?=$v['params']['r']?>);
                <?php endforeach; ?>
            <?php endif; ?>
        }
    
    </script>
</head>

<body onload="loadAll()">

    <img style="border: 1px solid gray" src="app.php?shapes=<?=$shapes?>" />

    <form method="post">

        <div id="container">

            <div id="template" style="display:none">
                <label>Фигура:</label>
                <select name="type[]" class="type">
                    <option value="circle">Круг</option>
                    <option value="square">Квадрат</option>
                </select>
                
                <label>Цвет:</label>
                <input class="color" type="color" name="color[]" placeholder="000000" style="width: 60px" />
                
                <label>Центр X:</label>
                <input class="x" type="text" name="x[]" style="width: 40px" />
                
                <label>Центр Y:</label>
                <input class="y" type="text" name="y[]" style="width: 40px" />
                
                <label>Радиус/Сторона:</label>
                <input class="r" type="text" name="r[]" style="width: 40px" />
            </div>
        
        </div>
        
        <div>
            <input type="button" value="Добавить фигуру" onclick="addShape('circle', '#000000', 0, 0, 0)" />
            <input type="submit" value="Нарисовать" />
        </div>

    </form>    
    
</body>

</html>