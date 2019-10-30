<?php

echo "<h2>Данные об объекте:</h2>";
foreach ($objectHeaders as $headersName => $value) {
    if ($headersName != 'id_customer' && $headersName != 'status_objects') {
        echo "<div><h4>$value</h4>".$objectInfo[0][$headersName]."</div>";
    }
}
echo "<div><h4>".$statusObjectsHeaders['status_objects']."</h4>".$statusObjectsInfo[0]['status_objects']."</div>";


echo "<h2>Данные о заказчике объекта:</h2>";
foreach ($customerHeaders as $headersName => $value) {
    if ($headersName != 'id') {
        echo "<div><h4>$value</h4>".$customerInfo[0][$headersName]."</div>";
    }
}

?>