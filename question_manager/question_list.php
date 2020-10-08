<?php include '../view/header.php'; ?>
<main>
    <h2>Question List</h2>
    <table>
        <tr>
            <th>Question</th>
            <th>Answer</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($questions as $question) : ?>
            <tr>
                <td><?php echo $question->getAddendOne(); ?></td>
                <td><?php echo $product->getName(); ?></td>
                <td class="right"><?php echo $product->getPriceFormatted(); ?>
                </td>
                <td><form action="." method="post"
                          id="delete_product_form">
                        <input type="hidden" name="action"
                               value="delete_product">
                        <input type="hidden" name="product_id"
                               value="<?php echo $product->getID(); ?>">
                        <input type="hidden" name="category_id"
                               value="<?php echo $current_category->getID(); ?>">
                        <input type="submit" value="Delete">
                    </form></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_form">Add Product</a></p>
</main>
<?php include '../view/footer.php'; ?>