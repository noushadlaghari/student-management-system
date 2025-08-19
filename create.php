<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link rel="stylesheet" href="css/create.css">
</head>

<body>
    <div class="container">
        <div id="message"></div>
        <h2>Add Student</h2>
        <form id="form">
            <div>
                <label for="rollno">Roll No:</label>
                <input type="text" id="rollno" name="rollno" required>
            </div>

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="fname">Father Name:</label>
                <input type="text" id="fname" name="fname" required>
            </div>

            <div>
                <label for="class">Class:</label>
                <input type="text" id="class" name="class" required>
            </div>

            <div>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div>
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="full-width">
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required>
            </div>

            <button id="submit">Submit</button>
        </form>
    </div>



    <script>
        let submit = document.getElementById('submit');
        let message = document.getElementById('message');

        let name = document.getElementById('name')
        let age = document.getElementById('age')
        let city = document.getElementById('city')


        submit.addEventListener('click', (e) => {
            e.preventDefault();

            let xhr = new XMLHttpRequest();
            let form = document.getElementById('form');
            let formData = new FormData(form);
            formData.append('action', 'insert');

            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {



                    let response = JSON.parse(xhr.responseText)
                    message.innerHTML = response["success"] ?? response["error"];

                    name.value = "";
                    city.value = "";
                    age.value = "";

                    setTimeout(() => {
                        message.innerHTML = "";
                        window.location.href = "index.php";
                    }, 2000)
                }
            }
            xhr.open('POST', 'request_handler.php', true);
            xhr.send(formData);

        })
    </script>
</body>

</html>