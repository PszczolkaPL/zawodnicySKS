<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Players</title>
</head>
<body>
    <?php
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


        function displayMessage($message){
            echo "<p class='success-message'>$message</p>";
            echo '<script>
                var successMessage = document.querySelector(".success-message");
                if (successMessage) {
                    //clear inputs
                    document.querySelectorAll("input").forEach(function(input) {
                        input.value = "";
                    });
                    setTimeout(function() {
                        successMessage.style.display = "none";
                    }, 2000);
                }</script>';
            header("Location: " . $_SERVER['PHP_SELF']);
        }
    ?>
    <div>
    <h3>Add new player</h3>
        <form method="post" action="" class="form">
            
            <input id="name" type="text" name="name" placeholder="Name" required>
            <input id="surname" type="text" name="surname" placeholder="Surname" required>
            
            <input id="class" type="number" name="class" placeholder="Class" required>
            <input id="birthdate" type="date" name="birthdate" placeholder="Birth Date" required>
            <input id="height" type="number" name="height" placeholder="Height" max="350" min="1" required>

            <button type="submit" name="submit">Add Player</button>

            <button type="submit" name="edit">Edit Player</button>
            <button type="submit" name="delete">Delete Player</button>
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
                    displayMessage("Player was added successfully");
                } else {
                    //display error message
                    echo "Error: ". $sqlInsert->error;
                }
                $sqlInsert->close();
            }   
        ?>
    <div>
        <script>
            //display selected value in inputs
            document.getElementById("userSelected").addEventListener("change", function() {
                var userDetails = this.value.trim().split(" ");
                var name = userDetails[0];
                var surname = userDetails[1];
                var classNumber = userDetails[2];
                var birthdate = userDetails[3];
                var height = userDetails[4];
                var id = this.selectedOptions[0].dataset.id;

                document.getElementById("name").value = name;
                document.getElementById("surname").value = surname; 
                document.getElementById("class").value = classNumber;
                document.getElementById("birthdate").value = birthdate;
                document.getElementById("height").value = height;
                document.getElementById("playerID").value = id; // Set the hidden ID input
            });
        </script>
        <input list="users" name="Choose User" id="userSelected">
        <datalist id="users">
            <?php
                //display all users and add them to datalist
                $sqlOptionUsers = "SELECT * FROM $table";
                $result = $mysqlConnect->query($sqlOptionUsers);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option id='option" . $row["id"] . "' value='" . $row["imie"] . " " . $row["nazwisko"] . " " . $row["klasa"] . " " . $row["rokurodzenia"] . " " . $row["wzrost"] . "' data-id='" . $row["id"] . "'></option>";
                    }
                } else {
                    echo "0 results";
                }
            ?>
        </datalist>

        <?php
        //edit player in database
            if (isset($_POST["edit"]) && isset($_POST["playerID"])) {
                $id = $_POST["playerID"];

                $name = $_POST["name"];
                $surname = $_POST["surname"];
    
                $class = $_POST["class"];
                $birthdate = $_POST["birthdate"];
                $height = $_POST["height"];  
                
                $sqlUpdate = $mysqlConnect->prepare("UPDATE $table SET $column1 = ?, $column2 = ?, $column3 = ?, $column4 = ?, $column5 = ? WHERE id = ?");
                $sqlUpdate->bind_param("ssissi", $name, $surname, $class, $birthdate, $height, $id);

                if ( $sqlUpdate->execute() ) {
                    displayMessage("Player was added successfully");
                } else {
                    echo "Error: ". $sqlUpdate->error;
                }
                $sqlUpdate->close();
            }
        ?>


        <?php
            //delete player from database
            if ( isset( $_POST["delete"] ) ) {
                $id = $_POST["playerID"];
                $sqlDelete = $mysqlConnect->prepare("DELETE FROM $table WHERE id = ?");
                $sqlDelete->bind_param("i", $id);
                if ( $sqlDelete->execute() ) {
                    displayMessage("Player was deleted successfully");
                } else {
                    echo "Error: ". $sqlDelete->error;
                }
                $sqlDelete->close();
            }
        ?>


    </div>

    <script src="scriptEdytuj.js"></script>
    <?php
        //close connection with database
        $mysqlConnect->close();
    ?>
</body>
</html>