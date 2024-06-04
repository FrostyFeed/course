<?php

// Перевіряємо, чи є результати пошуку у сесії
if (isset($_SESSION['search_results'])) {
    $search_results = $_SESSION['search_results'];
    // Очищаємо результати пошуку з сесії, оскільки вони більше не потрібні
    unset($_SESSION['search_results']);
}
?>

    <!-- Відображення результатів пошуку -->
    <?php if (isset($search_results) && !empty($search_results)): ?>
        <h2>Результати пошуку</h2>
        <table>
            <tr>
                <th>Ім'я</th>
                <th>Прізвище</th>
                <th>Дата народження</th>
                <th>Номер кімнати</th>
                <th>Дії</th>
            </tr>
            <?php foreach ($search_results as $resident): ?>
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
        </table>
        <script src="views/script.js"></script>
    <?php endif; ?>