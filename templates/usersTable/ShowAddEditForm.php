<div>
    <div class='container'>
        <div class='row justify-content-center'>
            <form action="<?= $URL ?>" method="POST" class="text-center p-3">
                <?php
                foreach ($columnsNames as $name) {
                    if ($name != 'id') {
                        if ($name == 'group_workers') {

                            echo "<label>" . (empty($tableHeaders[$name]) ? $name : $tableHeaders[$name]);
                            echo "<br><select name='group_workers' class='form-control custom-select mb-4'>";
                            foreach ($userGroup as $id => $groupName) {
                                if ($editValues['group_workers'] == $id) {
                                    echo "<option value='$id' selected='selected'>$groupName</option>";
                                } else {
                                    echo "<option value='$id'>$groupName</option>";
                                }
                                
                            }

                            echo "</select></lable><br>";
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