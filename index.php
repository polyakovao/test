<!DOCTYPE html>
<html>
<head>
    <title>Управление пользователями</title>
    <style>
        /* no styles */
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Форма редактирования пользователей</h1>
<form id="user-form">
    <input type="hidden" id="editUserId" value="">
    <label for="firstName">Имя:</label>
    <input type="text" id="firstName" required>
    <label for="lastName">Фамилия:</label>
    <input type="text" id="lastName" required>
    <label for="position">Должность:</label>
    <select id="position">
        <option value="программист">Программист</option>
        <option value="менеджер">Менеджер</option>
        <option value="тестировщик">Тестировщик</option>
    </select>
    <button type="button" id="add-edit-button">Save</button>
</form>

<h2>Список пользователей</h2>
<table id="user-table">
    <thead>
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Должность</th>
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<h2>Список товаров</h2>
<table id="goods-table">
    <thead>
    <tr>
        <th>Имя товара</th>
        <th>название допполя1</th>
        <th>значение допполя1</th>
        <th>название допполя2</th>
        <th>значение допполя2</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script src="script.js"></script>
</body>
</html>