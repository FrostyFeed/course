<h2>Кімнати</h2>
<table>
    <tr>
        <th>Номер кімнати</th>
        <th>Кількість місць</th>
        <th>Кількість вільних місць</th>
        <th>Дії</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo htmlspecialchars($room['room_number']); ?></td>
            <td><?php echo htmlspecialchars($room['capacity']); ?></td>
            <td><?php echo htmlspecialchars($room['free_seats']); ?></td>
            <td>
                <form action="action/room_action.php" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
                    <button type="submit">Видалити</button>
                </form>
                <form action="action/room_action.php" method="post" style="display:inline;">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
                    <input type="hidden" name="room_number" value="<?php echo $room['room_number']; ?>">
                    <input type="hidden" name="capacity" value="<?php echo $room['capacity']; ?>">
                    <button type="submit">Редагувати</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<h3>Додати нову кімнату</h3>
<form action="action/room_action.php" method="post">
    <input type="hidden" name="action" value="add">
    <label for="room_number">Номер кімнати:</label>
    <input type="text" id="room_number" name="room_number" required>
    <label for="capacity">Кількість місць:</label>
    <input type="number" id="capacity" name="capacity" required>
    <button type="submit">Додати</button>
</form>
