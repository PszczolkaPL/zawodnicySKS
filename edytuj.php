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
        $dataBase = "zawodnicy";
        $server = "localhost";
        $user = "root";
        $mysqlConnect = new mysqli($server, $user,"", $dataBase);
        if ($mysqlConnect->connect_error) {
            die("Connection failed: " . $mysqlConnect->connect_error);
        }
    ?>
    <div>
        <form method="post" action="">
            <h3>Add new player</h3>
            <input id="name" type="text" name="name" placeholder="Name" required>
            <input id="surname" type="text" name="surname" placeholder="Surname" required>
            <input id="class" type="number" name="class" placeholder="Class" required>
            <input id="birthdate" type="date" name="birthdate" placeholder="Birth Date" required>
            <input id="height" type="number" name="height" placeholder="Height" required>
            <button type="submit" name="submit">Add Player</button>
        </form>
    </div>

        <?php
            $table = "zawodnicy";
            $column1 = "imie";
            $column2 = "nazwisko";
            $column3 = "klasa";
            $column4 = "rokurodzenia";
            $column5 = "wzrost";

            //add new player
            if ( isset( $_POST["submit"] ) ) {
                

                $name = $_POST["name"];
                $surname = $_POST["surname"];

                $class = $_POST["class"];
                $birthdate = $_POST["birthdate"];
                $height = $_POST["height"];

                $sqlInsert = $mysqlConnect->prepare("INSERT INTO $table ($column1, $column2, $column3, $column4, $column5) VALUES (?, ?, ?, ?, ?)");
                $sqlInsert->bind_param("ssisi", $name, $surname, $class, $birthdate, $height);
                if ( $sqlInsert->execute() ) {
                    echo '<p class="success-message">New player was added successfully</p>';
                    echo '<script>
                            setTimeout(function() {
                                document.querySelector(".success-message").style.display = "none";
                            }, 2000);
                        </script>';
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();  
                } else {
                    echo "Error: ". $sqlInsert->error;
                }
                $sqlInsert->close();
            }   
        ?>
    <div>
        <input list="users" name="Choose User" id="userSelected">
        <datalist id="users">
            <?php
            //display all users and add them to datalist
                $sqlOptionUsers = "SELECT * FROM $table";
                $result = $mysqlConnect->query($sqlOptionUsers);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option id='option" . $row["id"] . "' value=' " . $row["imie"] . " " . $row["nazwisko"] . " " . $row["klasa"] . " " . $row["rokurodzenia"] . " " . $row["wzrost"] ." '></option>";
                    }
                } else {
                    echo "0 results";
                }
            ?>
        </datalist>
        <script>
            //display selected value in inputs
            document.getElementById("userSelected").addEventListener("change", function() {
                var userDetails = this.value.trim().split(" ");
                var name = userDetails[0];
                var surname = userDetails[1];
                var classNumber = userDetails[2];
                var birthdate = userDetails[3];
                var height = userDetails[4];
                document.getElementById("name").value = name;
                document.getElementById("surname").value = surname; 
                document.getElementById("class").value = classNumber;
                document.getElementById("birthdate").value = birthdate;
                document.getElementById("height").value = height;
            })
        </script>
        <button id="edytuj" method="post">Edit</button>
        <?php
        //edit player in database
            if ( isset( $_POST["edytuj"] ) ) {
                $id = $_POST["userSelected"];
                $sqlUpdate = $mysqlConnect->prepare("UPDATE $table SET $column1 = ?, $column2 = ?, $column3 = ?, $column4 = ?, $column5 = ? WHERE id = ?");
                $sqlUpdate->bind_param("ssissi", $name, $surname, $class, $birthdate, $height, $id);
                if ( $sqlUpdate->execute() ) {
                    echo '<p class="success-message">Player was updated successfully</p>';
                    echo '<script>
                            setTimeout(function() {
                                document.querySelector(".success-message").style.display = "none";
                            }, 2000);
                        </script>';
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();  
                } else {
                    echo "Error: ". $sqlUpdate->error;
                }
                $sqlUpdate->close();
            }
        ?>

    <button id="usun">Delete</button>
    </div>
    <?php
        $mysqlConnect->close();
    ?>
</body>
</html>