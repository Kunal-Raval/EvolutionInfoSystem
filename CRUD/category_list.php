<div class="container">
    <h1>Category Table</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Category Name</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;


            foreach ($conn->query("SELECT c_name, created_date FROM category WHERE `status` = 0") as $row) {
                ?>
            <tr>
                <td>
                    <?php echo $i ?>
                </td>
                <td>
                    <?php echo $row['c_name']; ?>
                </td>
                <td>
                    <?php echo $row['created_date']; ?>
                </td>
            </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>