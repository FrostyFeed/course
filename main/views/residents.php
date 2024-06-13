<h2>Мешканці</h2>
<h3 id="addRes">Додати нового мешканця</h3>

<form action="action/resident_action.php" method="post" id="res">
    <input type="hidden" name="action" value="add">
    <label for="first_name">Ім'я:</label>
    <input type="text" id="first_name" name="first_name" required>
    <label for="last_name">Прізвище:</label>
    <input type="text" id="last_name" name="last_name" required>
    <label for="date_of_birth">Дата народження:</label>
    <input type="date" id="date_of_birth" name="date_of_birth" required>
    <label for="room_id">Номер кімнати:</label>
    <input style="width: 55px;" type="number" id="room_id_add" name="room_id" required>
    <label for="course">Курс:</label>
    <input style="width: 35px;" min="1" max="4" type="number" id="course" name="course" required>
    <button type="button" id="freeRoom">Знайти вільну кімнату</button>
    <button type="submit">Додати</button>
    <?php
        if (isset($_GET['error'])) {
            echo '<label class="error">' . htmlspecialchars($_GET['error']) . '</label>';
        }
    ?>
</form>
<h3 id="search">Пошук</h3>
<form action="action/resident_action.php" method="post">
    <input type="hidden" name="action" value="search">
    <input type="text" name="name" placeholder="Ім'я">
    <input type="text" name="secondName" placeholder="Прізвище">
    <input type="date" name="date" placeholder="Дата народження">
    <input type="text" name="room" placeholder="Номер кімнати">
    <input type="text" name="course" placeholder="Курс">
    <button type="submit">Шукати</button>
</form>
<?php include 'search_results.php'; ?>
<h3 id="totalRes"></h3>
<table id="residentsTable" class="main">
    <tr>
        <th>Ім'я</th>
        <th>Прізвище</th>
        <th>Дата народження</th>
        <th>Номер кімнати</th>
        <th>Курс</th>
        <th>Дії</th>
    </tr>
    <?php foreach ($residents as $resident): ?>
    <tr id="record">
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


