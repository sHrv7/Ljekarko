<div class="container mt-4">
    <h1 class="mb-3">Upravljaj proizvodima</h1>
    <div class="table-container" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-bordered products-table">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Slika</th>
                    <th>Opis</th>
                    <th>Cijena</th>
                    <th>Količina</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <form action="scripts/addProductsScript.php" method="POST">
                        <td><textarea name="name"></textarea></td>
                        <td><textarea name="image"></textarea></td>
                        <td><textarea name="description"></textarea></td>
                        <td><input type="number" class="numInputs" step="0.01" name="price"></td>
                        <td><input type="number" class="numInputs" name="quantity"></td>
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
                $sql = "SELECT * FROM products ORDER BY `Name` ASC";

                // Execute query
                $result = $conn->query($sql);

                // Check if there are any results
                if ($result->num_rows > 0) {
                    // Fetch data from each row and display it in the table

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<form action='scripts/editProductsScript.php' method='POST'>";
                        echo "<input type='hidden' name='oldName' value='" . $row['Name'] . "'>";
                        echo "<td><textarea name='name'>" . $row['Name'] . "</textarea></td>";
                        echo "<td><textarea name='image'>" . $row['Image'] . "</textarea></td>";
                        echo "<td><textarea name='description'>" . $row['Description'] . "</textarea></td>";
                        echo "<td><input class='numInputs' type='number' step='0.01' name='price' value='" . $row['Price'] . "'></td>";
                        echo "<td><input class='numInputs' type='number' name='quantity' value='" . $row['Quantity'] . "'></td>";
                        echo "<td>";
                        echo "<button type='submit' class='btn btn-primary btn-sm me-2'>Uredi</button>";
                        echo "</form>";
                        echo "<br>";
                        echo "<form action='scripts/deleteProductsScript.php' method='POST'>";
                        echo "<input type='hidden' name='name' value='" . $row['Name'] . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Jeste li sigurni da želite izbrisati ovaj proizvod?\")'>Obriši</button>";
                        echo "</form>";
                        echo "<form action='orderProducts.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='btn btn-info btn-sm'>Naruči</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nema pronađenih proizvoda</td></tr>";
                }

                // Close database connection
                $conn->close();
                ?>


            </tbody>
        </table>
    </div>
</div>