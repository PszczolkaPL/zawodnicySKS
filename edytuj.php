<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Players</title>
</head>
<body>
    <?php
    session_start();
    //Connect to database
        //databse credentials
        $dataBase = "zawodnicy";
        $server = "localhost";
        $user = "root";

        //create connection
        $mysqlConnect = new mysqli($server, $user,"", $dataBase);
        //check connection
        if ($mysqlConnect->connect_error) {
            die("Connection failed: " . $mysqlConnect->connect_error);
        }

        function handleSuccess($message) {
            $_SESSION['success_message'] = $message;
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit();
        }

        function displayMessage(){
            if (isset($_SESSION['success_message'])) {
                echo "<p class='success-message'>" . $_SESSION['success_message'] . "</p>";
                unset($_SESSION['success_message']);
                echo '<script>
                        setTimeout(function() {
                            var successMessage = document.querySelector(".success-message");
                            if (successMessage) {
                                successMessage.style.display = "none"; // Hide the message after 2 seconds
                            }
                        }, 2000); // Adjust the timeout duration as needed
                      </script>';
            }
        }
    ?>
    <div>
        <h3>Add Player</h3>
        <form method="post" action="" class="form">
            
            <input id="name" type="text" name="name" placeholder="Name" required>
            <input id="surname" type="text" name="surname" placeholder="Surname" required>
            
            <input id="class" type="number" name="class" placeholder="Class" required>
            <input id="birthdate" type="date" name="birthdate" placeholder="Birth Date" required>
            <input id="height" type="number" name="height" placeholder="Height" max="350" min="1" required>

            <button type="submit" name="submit">Add Player</button>

            <input list="users" name="Choose User" id="userSelected">

            <button type="submit" name="edit">Edit</button>
            <button type="submit" name="delete">Delete</button>
            <input type="hidden" id="userId" name="userId">

        </form>
    </div>
        <?php
            //inputs from form
            $table = "zawodnicy";
            $column1 = "imie";
            $column2 = "nazwisko";
            $column3 = "klasa";
            $column4 = "rokurodzenia";
            $column5 = "wzrost";

            //add new player
            if ( isset( $_POST["submit"] ) ) {
                
                //get values from form
                $name = $_POST["name"];
                $surname = $_POST["surname"];
    
                $class = $_POST["class"];
                $birthdate = $_POST["birthdate"];
                $height = $_POST["height"];

                //insert into database
                $sqlInsert = $mysqlConnect->prepare("INSERT INTO $table ($column1, $column2, $column3, $column4, $column5) VALUES (?, ?, ?, ?, ?)");
                $sqlInsert->bind_param("ssisi", $name, $surname, $class, $birthdate, $height);

                //check if insert was successful
                if ( $sqlInsert->execute() ) {
                    handleSuccess("Player was added successfully");
                } else {
                    //display error message
                    echo "Error: ". $sqlInsert->error;
                }
                $sqlInsert->close();
            }

            //Edit selected player
            if (isset($_POST["edit"])) {
                $id = $_POST['userId'];

                $name = $_POST["name"];
                $surname = $_POST["surname"];
    
                $class = $_POST["class"];
                $birthdate = $_POST["birthdate"];
                $height = $_POST["height"];  
                
                $sqlUpdate = $mysqlConnect->prepare("UPDATE $table SET $column1 = ?, $column2 = ?, $column3 = ?, $column4 = ?, $column5 = ? WHERE id = ?");
                $sqlUpdate->bind_param("ssissi", $name, $surname, $class, $birthdate, $height, $id);

                if ( $sqlUpdate->execute() ) {
                    handleSuccess("Player was added successfully");
                } else {
                    echo "Error: ". $sqlUpdate->error;
                }
                $sqlUpdate->close();
            }

            //delete player from database
            if ( isset( $_POST["delete"] ) ) {
                $id = $_POST["userId"];

                $sqlDelete = $mysqlConnect->prepare("DELETE FROM $table WHERE id = ?");
                $sqlDelete->bind_param("i", $id);

                if ( $sqlDelete->execute() ) {
                    handleSuccess("Player was deleted successfully");
                } else {
                    echo "Error: ". $sqlDelete->error;
                }
                $sqlDelete->close();
            }
        ?>


        <datalist id="users">
            <?php
                //display all users and add them to datalist
                $sqlOptionUsers = "SELECT * FROM $table";
                $result = $mysqlConnect->query($sqlOptionUsers);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option id='" . $row["id"] . "' value='" . $row["imie"] . " " . $row["nazwisko"] . " " . $row["klasa"] . " " . $row["rokurodzenia"] . " " . $row["wzrost"] . " " . $row["id"] . "'></option>";
                    }
                } else {
                    echo "0 results";
                }
            ?>
        </datalist>
        <script>
            //display selected value in inputs
            const playerList = document.getElementById("userSelected");
            playerList.addEventListener("change", function() {
                var userDetails = this.value.trim().split(" ");
                
                var name = userDetails[0];
                var surname = userDetails[1];
                var classNumber = userDetails[2];
                var birthdate = userDetails[3];
                var height = userDetails[4];
                var userId = userDetails[5];

                document.getElementById("name").value = name;
                document.getElementById("surname").value = surname; 
                document.getElementById("class").value = classNumber;
                document.getElementById("birthdate").value = birthdate;
                document.getElementById("height").value = height;
                document.getElementById("userId").value = userId;
            });


            const editButton = document.getElementById("edit");
            const deleteButton = document.getElementById("delete");
            
            if(playerList.value === "") {
                editButton.disabled = true;
                editButton.style.color = "gray";

                deleteButton.disabled = true;
                deleteButton.style.color = "gray";
            }
        </script>

    <?php
        //close connection with database
        displayMessage();
        $mysqlConnect->close();
    ?>
</body>
</html>