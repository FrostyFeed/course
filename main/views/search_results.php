<?php

if (isset($_SESSION['search_results'])) {
    $search_results = $_SESSION['search_results'];
   
    unset($_SESSION['search_results']);
}
?>

    <?php if (isset($search_results) && !empty($search_results)): ?>
        <h2>Результати пошуку</h2>
        <button id="dltSelected">Видалити вибране</button>
        <button id="dltAll">Видалити все</button>
        <h3 id="totalRes"></h3>
        <table id="residentsTable" class="searchResults">
            <tr>
                <th> </th>
                <th>Ім'я</th>
                <th>Прізвище</th>
                <th>Дата народження</th>
                <th>Номер кімнати</th>
                <th>Курс</th>
                <th>Дії</th>
            </tr>
            <?php foreach ($search_results as $resident): ?>
                <tr>
                    <td><?php echo '<input type="checkbox" name="select" id="select" value="' .htmlspecialchars($resident['resident_id']). '">';  ?></td>
                    <td><?php echo '<input id="first_name" class="field" style="border: none; font-size: 16px;" type="text" value="' . htmlspecialchars($resident['first_name']) . '">'; ?></td>
                    <td><?php echo '<input id="last_name" class="field" style="border: none; font-size: 16px;" type="text" value="' . htmlspecialchars($resident['last_name']) . '">'; ?></td>
                    <td><?php echo '<input id="date" class="field" style="border: none; font-size: 16px;" type="date" value="' . htmlspecialchars($resident['date_of_birth']) . '">'; ?></td>
                    <td><?php echo '<input id="room" class="field" style="border: none; font-size: 16px;" type="text" value="' . htmlspecialchars($resident['room_id']) . '">';  ?></td>
                    <td><?php echo '<input id="course_in" class="field" style="border: none; font-size: 16px;" type="text" value="' . htmlspecialchars($resident['course']) . '">';  ?></td>
                    <td>
                        <input type="hidden" name="resident_id" id="id" value="<?php echo htmlspecialchars($resident['resident_id']); ?>">
                        <button type="submit" id="dlt">Видалити</button>
                        <input id="resident_id" class="field" type="hidden" name="resident_id" value="<?php echo htmlspecialchars($resident['resident_id']); ?>">
                        <button id="sbt" type="submit">Редагувати</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <hr>
        <script src="views/search.js"></script>
    <?php endif; ?>
    