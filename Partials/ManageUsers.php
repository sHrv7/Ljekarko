<div class="container mt-4">
    <h1 class="mb-3">Upravljaj korisnicima</h1>
    <div class="table-container" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-bordered news-table">
            <thead>
                <tr>
                    <th>Korisničko ime</th>
                    <th>Administratorske ovlasti</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Connect to the database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "Ljekarko";
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to select all user data
                $sql = "SELECT * FROM users";

                // Execute query
                $result = $conn->query($sql);

                $empty = 0;

                // Check if there are any results
                if ($result->num_rows > 1) {
                    while ($row = $result->fetch_assoc()) {
                        if (!($row['Username'] == "Admin" || $row['Username'] == "admin" || $row['Username'] == $_SESSION['username'])) {
                            $empty++;
                            echo "<tr>";
                            echo "<form action='scripts/editUserScript.php' method='POST'>";
                            echo "<input type='hidden' name='username' value='" . $row['Username'] . "'>";
                            echo "<td>" . $row['Username'] . "</td>";
                            echo "<input type='hidden' name='admin' value='" . $row['Admin'] . "' >";
                            echo "<td>";
                            if ($row['Admin']) {
                                echo "<button type='submit' class='btn btn-danger btn-sm me-2'>Makni administratorkse ovlasti</button>";
                            } else {
                                echo "<button type='submit' class='btn btn-primary btn-sm me-2'>Postavi administratorkse ovlasti</button>";
                            }
                            echo "</form>";
                            echo "</td>";
                            echo "<td>";
                            echo "<form action='scripts/deleteOtherUserScript.php' method='POST'>";
                            echo "<input type='hidden' name='username' value='" . $row['Username'] . "'>";
                            echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Jeste li sigurni da želite izbrisati ovog korisnika?\")'>Obriši</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                }
                if ($empty == 0) {
                    echo "<tr><td colspan='2'>Nema korisnika koji se mogu urediti</td></tr>";
                }

                // Close database connection
                $conn->close();
                ?>


            </tbody>
        </table>
    </div>
</div>