<h2 id="roms">Кімнати</h2>
<table style="width: fit-content;" class="rooms">
    <tr>
        <th>Номер кімнати</th>
        <th>Кількість місць</th>
        <th>Кількість вільних місць</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
        <tr id="room">
            <td id="number"><?php echo htmlspecialchars($room['room_number']); ?></td>
            <td id="capacity"><?php echo htmlspecialchars($room['capacity']); ?></td>
            <td id="free_seats"><?php echo htmlspecialchars($room['free_seats']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<h3 id="addRoom">Додати нову кімнату</h3>
<form action="action/room_action.php" method="post">
    <input type="hidden" name="action" value="add">
    <label for="room_number">Номер кімнати:</label>
    <input type="text" id="room_number" name="room_number" required>
    <label for="capacity">Кількість місць:</label>
    <input type="number" id="capacity" name="capacity" required>
    <button type="submit">Додати</button>
</form>
