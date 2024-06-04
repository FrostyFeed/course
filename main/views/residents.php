<h2>Мешканці</h2>
<form action="action/resident_action.php" method="post">
    <input type="hidden" name="action" value="search">
    <input type="text" name="search" placeholder="Пошук мешканця">
    <button type="submit">Шукати</button>
</form>
<table>
    <tr>
        <th>Ім'я</th>
        <th>Прізвище</th>
        <th>Дата народження</th>
        <th>Номер кімнати</th>
        <th>Дії</th>
    </tr>
    <?php foreach ($residents as $resident): ?>
    <tr>
        <td><?php echo '<input id="first_name" style="border: none; font-size: 16px;" type="text" value="' . htmlspecialchars($resident['first_name']) . '">'; ?></td>
        <td><?php echo '<input id="last_name" style="border: none; font-size: 16px;" type="text" value="' . htmlspecialchars($resident['last_name']) . '">'; ?></td>
        <td><?php echo '<input id="date" style="border: none; font-size: 16px;" type="date" value="' . htmlspecialchars($resident['date_of_birth']) . '">'; ?></td>
        <td><?php echo '<input id="room" style="border: none; font-size: 16px;" type="text" value="' . htmlspecialchars($resident['room_id']) . '">';  ?></td>
        <td>
            <form action="action/resident_action.php" method="post" style="display:inline;">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="resident_id" value="<?php echo htmlspecialchars($resident['resident_id']); ?>">
                <button type="submit">Видалити</button>
            </form>
            <input id="resident_id" type="hidden" name="resident_id" value="<?php echo htmlspecialchars($resident['resident_id']); ?>">
            <button id="sbt" type="submit">Редагувати</button>
        </td>
    </tr>
<?php endforeach; ?>
<script src="views/script.js"></script>
</table>
<h3>Додати нового мешканця</h3>
<form action="action/resident_action.php" method="post">
    <input type="hidden" name="action" value="add">
    <label for="first_name">Ім'я:</label>
    <input type="text" id="first_name" name="first_name" required>
    <label for="last_name">Прізвище:</label>
    <input type="text" id="last_name" name="last_name" required>
    <label for="date_of_birth">Дата народження:</label>
    <input type="date" id="date_of_birth" name="date_of_birth" required>
    <label for="room_id">Номер кімнати:</label>
    <input type="number" id="room_id" name="room_id" required>
    <button type="submit">Додати</button>
    <?php
        if (isset($_GET['error'])) {
            echo '<label class="error">' . htmlspecialchars($_GET['error']) . '</label>';
        }
    ?>
</form>
