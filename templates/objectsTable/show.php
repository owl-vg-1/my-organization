<div class="container-fluid">
    <div class="row justify-content-end p-2">
        <form action="<?=$searchObjectURL?>" method="POST" class="text-center p-3">
            <label> Поиск объекта
                <input class='form-control' type='text' name='searchObject'>
            </label>
            <input class="btn btn-info" type="submit" value="Найти">
        </form>
    </div>
</div>


<?php
$paginationHTML = "<nav aria-label='Page navigation example'><ul class='pagination justify-content-center paginationHTML'><li class='page-item'><a class='page-link' href='" . $paginationLink . max($currentPage - 1, 1) . "'><<</a></li>";
for ($i = 1; $i <= $pageCount; $i++) {
    $paginationHTML .= '<li class="page-item ' . (($i == $currentPage) ? "active" : "") . '"><a class="page-link " href="' . $paginationLink . $i . '">' . $i . '</a></li>';
}
$paginationHTML .= "<li class='page-item'><a class='page-link' href='" . $paginationLink . min($currentPage + 1, $pageCount) . "'>>></a></li></ul></nav>";

echo $paginationHTML;


echo "<div class='container'><div class='row justify-content-center'>";

echo "<table class='table table-striped table-dark'>";

echo "<tr>";
foreach ($tableHeaders as $fieldName => $th ) {
    echo "<th>".(empty($th) ? $fieldName : $th)."</th>";
}
echo "<th></th></tr>";

foreach ($table as $row) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    // тест на ссылку вывода подробной информации
    echo "<td><a href='?t=" . $controllerName . "&a=ShowDetails&id=" . $row['id'] . "' class='btn btn-primary'>Show Details</a></td>";


    echo "</tr>";

}
echo "</table>";
if ($deleteEditAccess) {
    echo "<a href='?t=" . $controllerName . "&a=ShowAddForm' class='btn btn-success'>Add new</a>";
}
echo "</div></div>";

echo $paginationHTML;


