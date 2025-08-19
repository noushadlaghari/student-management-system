<!DOCTYPE html>
<html>

<head>
    <title>Students</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <h2>Students List</h2>
    <div class="container">
        <a href="create.php" class="add">+ Add Student</a>
        <div id="message"></div>
        <table id="students_table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </table>
    </div>

    <script>
        function fetchAll() {

            let students_table = document.getElementById("students_table");
            let formdata = new FormData();
            formdata.append('action', 'getAll');
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {

                if (xhr.readyState == 4 && xhr.status == 200) {
                    students = JSON.parse(xhr.responseText);
                    students_table.innerHTML = `
                        <tr>
                            <th>SNo.</th>
                            <th>Name</th>
                            <th>Father's Name</th>
                            <th>Class</th>
                            <th>Age</th>
                            <th>City</th>
                            <th>Roll No</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    `;

                    students.forEach((student,index) => {
                        students_table.innerHTML += `
                             <tr>
                                <td>${index+1}</td>
                                <td>${student['name']}</td>
                                <td>${student['fname']}</td>
                                <td>${student['class']}</td>
                                <td>${student['age']}</td>
                                <td>${student['city']}</td>
                                <td>${student['rollno']}</td>
                                <td>${student['contact']}</td>
                                <td>
                                    <a href="update.php?id=${student['id']}" class="edit">Edit</a>
                                    <button class="delete" onclick="delete_student(${student['id']})">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                }
            }
            xhr.open("POST", "request_handler.php");
            xhr.send(formdata);
        }

        fetchAll();


        function delete_student(id) {

            let message = document.getElementById("message")
            let formdata = new FormData();
            formdata.append('id', id);
            formdata.append('action', 'delete');

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    fetchAll();

                    let response = JSON.parse(xhr.responseText);

                    message.innerHTML = response['success']??response["error"];

                    setTimeout(()=>{
                        message.innerHTML="";
                    },2000)

                }
            }


            xhr.open('POST', 'request_handler.php', true);
            xhr.send(formdata);
        }
    </script>
</body>

</html>