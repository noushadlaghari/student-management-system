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
        let urlParameters = new URLSearchParams(window.location.search);
        let id = urlParameters.get("id");
        let message = document.getElementById("message")


        let submit = document.getElementById("submit")
        let form = document.getElementById("form")


        submit.addEventListener('click', (e) => {
            e.preventDefault();

            let formdata = new FormData(form);
            formdata.append('action', 'update');
            formdata.append('id', id);

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    get_data();

                    let response = JSON.parse(xhr.responseText);
                    let message_text = response["success"] ?? response["error"];

                    message.innerHTML = message_text;

                    setTimeout(() => {

                        message.innerHTML = "";
                    }, 2000)
                }
            }

            xhr.open('POST', 'request_handler.php', true);
            xhr.send(formdata);


        })


        function get_data() {

            let name = document.getElementById('name')
            let age = document.getElementById('age')
            let city = document.getElementById('city')
            let fname = document.getElementById('fname')
            let class_name = document.getElementById('class')
            let rollno = document.getElementById('rollno')
            let contact = document.getElementById('contact')

            let formdata = new FormData();

            formdata.append('action', 'getById');
            formdata.append('id', id);

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {

                    let data = JSON.parse(xhr.responseText)
                    name.setAttribute('value', data['name'])
                    age.setAttribute('value', data['age'])
                    city.setAttribute('value', data['city'])
                    class_name.setAttribute('value', data['class'])
                    fname.setAttribute('value', data['fname'])
                    rollno.setAttribute('value', data['rollno'])
                    contact.setAttribute('value', data['contact'])

                }
            }
            xhr.open('POST', 'request_handler.php', true);
            xhr.send(formdata);
        }
        get_data()
    </script>
</body>

</html>