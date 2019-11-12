<div>
    <div class='container'>
        <div class='row justify-content-center'>
            <form action="<?= $URL ?>" method="POST" class="text-center p-3">
                <?php
                foreach ($columnsNames as $name) {
                    if ($name != 'id') {
                        if ($name == 'id_customer') {

                            echo "<label>" . (empty($tableHeaders[$name]) ? $name : $tableHeaders[$name]);
                            echo "<br><select name='$name' class='form-control custom-select mb-4'>";
                            foreach ($costomer as $id => $costomerName) {
                                echo "<option value='$id'>$costomerName</option>";
                            }

                            echo "</select></lable><br>";
                        } elseif ($name == 'status_objects') {

                            echo "<label>" . (empty($tableHeaders[$name]) ? $name : $tableHeaders[$name]);
                            echo "<br><select name='$name' class='form-control custom-select mb-4'>";
                            foreach ($statusObjects as $id => $status) {
                                echo "<option value='$id'>$status</option>";
                            }

                            echo "</select></lable><br>";
                        } elseif ($name == 'beginning_works' || $name == 'end_work') {

                            echo "<label>"
                            . (empty($tableHeaders[$name]) ? $name : $tableHeaders[$name])
                            . "<input class='form-control mb-4' type='date' name='"
                            . $name . "' value='"
                            . ($editValues[$name] ?? '') . "'></label><br>";
                        } else {
                            echo "<label>"
                                . (empty($tableHeaders[$name]) ? $name : $tableHeaders[$name])
                                . "<input class='form-control mb-4' type='text' name='"
                                . $name . "' value='"
                                . ($editValues[$name] ?? '') . "'></label><br>";
                        }
                    }
                }
                ?>
                <input class="btn btn-info my-4" type="submit" value="OK">
            </form>
        </div>
    </div>
</div>