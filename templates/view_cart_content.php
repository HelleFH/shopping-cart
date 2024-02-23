<tr><td class="border border-gray-400">
                    <a href="includes/delete_item.php?id=<?php echo $row['id']; ?>&index=<?php echo $index; ?>"><span><i
                                class="fa fa-trash" aria-hidden="true"></i>
                        </span></a>
                </td>
                <td class="border border-gray-400"><img src="public/<?php echo $row['photo']; ?>" alt="Product Image"
                        class="w-16 h-16 object-cover"></td>
                <td class="border border-gray-400">
                    <?php echo $row['name']; ?>
                </td>
                <td class="border border-gray-400">£
                    <?php echo number_format($row['price'], 2); ?>
                </td>
                <input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
                <td class="border border-gray-400">
                    <div class="border border-gray-400 inline-block px-2">
                        <input type="text" class="form-control w-12" style="text-align:center"
                            value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index; ?>">
                    </div>
                </td>
                <td class="border border-gray-400">
                    £<?php echo number_format($_SESSION['qty_array'][$index] * $row['price'], 2); ?>
                </td>
                </tr>