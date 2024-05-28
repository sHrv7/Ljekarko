<div class="container mt-4">
    <h1 class="mb-3">Upravljaj vijestima</h1>
    <div class="table-container" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-bordered news-table">
            <thead>
                <tr>
                    <th>Naslov</th>
                    <th>Slika</th>
                    <th>Tekst</th>
                    <th>Datum</th>
                    <th>Poveznica</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <form action="scripts/addNewsScript.php" method="POST">
                        <td><textarea name="title"></textarea></td>
                        <td><textarea name="image"></textarea></td>
                        <td><textarea name="text"></textarea></td>
                        <td></td>
                        <td><textarea name='link'></textarea></td>
                        <td><button type="submit" class="btn btn-success btn-sm">Dodaj</button></td>
                    </form>
                </tr>

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

                // SQL query to select all news data
                $sql = "SELECT * FROM news ORDER BY `Date` DESC";

                // Execute query
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Fetch data from each row and display it in the table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<form action='scripts/editNewsScript.php' method='POST'>";
                        echo "<input type='hidden' name='oldTitle' value='" . $row['Title'] . "'>";
                        echo "<td><textarea name='title'>" . $row['Title'] . "</textarea></td>";
                        echo "<td><textarea name='image'>" . $row['Image'] . "</textarea></td>";
                        echo "<td><textarea name='text'>" . $row['Text'] . "</textarea></td>";
                        echo "<td>" . date('d.m.Y', strtotime($row['Date'])) . "</td>";
                        echo "<td><textarea name='link'>" . $row['Link'] . "</textarea></td>";
                        echo "<td>";
                        echo "<button type='submit' class='btn btn-primary btn-sm me-2'>Uredi</button>";
                        echo "</form>";
                        echo "<br>";
                        echo "<form action='scripts/deleteNewsScript.php' method='POST'>";
                        echo "<input type='hidden' name='title' value='" . $row['Title'] . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Jeste li sigurni da želite izbrisati ovu vijest?\")'>Obriši</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nema pronađenih vijesti</td></tr>";
                }

                // Close database connection
                $conn->close();
                ?>


            </tbody>
        </table>
    </div>
</div>