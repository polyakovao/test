$(document).ready(function () {
    const form = $("#user-form");
    const table = $("#user-table");
    const addButton = $("#add-edit-button");

    addButton.on("click", function () {
        const firstName = $("#firstName").val();
        const lastName = $("#lastName").val();
        const position = $("#position").val();
        const editUserId = $("#editUserId").val();

        if (editUserId) {
            $.ajax({
                type: "POST",
                url: "/users.php?action=edit",
                data: JSON.stringify({
                    firstName: firstName,
                    lastName: lastName,
                    position: position,
                    editUserId: editUserId
                }),
                contentType: "application/json",
                success: function (data) {
                    //console.log("Edit user:", data);
                    loadUsers();
                },
                error: function (xhr, status, error) {
                    console.error("Error editing user:", status, error);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "/users.php?action=create",
                data: JSON.stringify({
                    firstName: firstName,
                    lastName: lastName,
                    position: position
                }),
                contentType: "application/json",
                success: function (data) {
                    //console.log("New user added:", data);
                    loadUsers();
                },
                error: function (xhr, status, error) {
                    console.error("Error adding user:", status, error);
                }
            });
        }

        // clear form
        form[0].reset();
        $("#editUserId").val('');
    });

    // view in table
    function loadUsers() {
        $.get("/users.php?action=load", function (data) {
            var tbody = $("#user-table tbody");
            tbody.empty(); // Clear existing data

            var jsonData = JSON.parse(data);
            jsonData.forEach(function (user) {
                var row = $("<tr>");
                row.append($("<td>").text(user.firstname));
                row.append($("<td>").text(user.lastname));
                row.append($("<td>").text(user.position));

                var editButton = $("<button>")
                    .text("Edit")
                    .click(function() {
                        editUser(user);
                    });

                var deleteButton = $("<button>")
                    .text("Delete")
                    .click(function() {
                        deleteUser(user.id);
                    });

                var editCell = $("<td>").append(editButton);
                var deleteCell = $("<td>").append(deleteButton);

                row.append(editCell);
                row.append(deleteCell);

                tbody.append(row);
            });
        });
    }

    // delete user
    function deleteUser(userId) {
        $.get("/users.php?action=delete&id="+userId, function (data) {
            loadUsers();
        });
    }

    // edit user (this part insert data into inputs)
    function editUser(user) {
        $("#editUserId").val(user.id);
        $("#firstName").val(user.firstname);
        $("#lastName").val(user.lastname);
        $("#position").val(user.position);
    }

    // load table data
    loadUsers();

    function loadGoods() {
        $.get("/goods.php", function (data) {
            var tbody = $("#goods-table tbody");
            tbody.empty(); // Clear existing data

            var jsonData = JSON.parse(data);
            jsonData.forEach(function (goods) {
                var row = $("<tr>");
                row.append($("<td>").text(goods.name));
                row.append($("<td>").text(goods.name1));
                row.append($("<td>").text(goods.caption1));
                row.append($("<td>").text(goods.name2));
                row.append($("<td>").text(goods.caption2));

                tbody.append(row);
            });
        });
    }
    loadGoods();
});
