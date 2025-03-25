<div class="container">
    <div class="box">
        <h3>Shopping list</h3>
        <table>
            <thead style="background-color: cadetblue; font-weight: bold;">
                <tr>
                    <td>Name</td>
                    <td>Checked</td>
                    <td style="background-color: indianred"></td>
                    <td style="background-color: bisque"></td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item) { ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['checked']; ?></td>
                    <td><a href="<?php echo URL . 'shopping_list/item/' . $item['name']; ?>" style="color: black; text-decoration: none" >edit</a></td>
                    <td><a href="<?php echo URL . 'api/deleteItem/' . $item['name']; ?>" style="color: black; text-decoration: none" >remove</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="box">
        <h3>Add a item</h3>
        <form action="<?php echo URL; ?>api/addItem" method="POST">
            <input type="text" name="name" value="" required />
            <input type="submit" name="submit_add_item" value="Submit" />
        </form>
    </div>
</div>
