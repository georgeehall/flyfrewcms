Save for later

<!-- start of container-->
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <form method="post" action="submit-item.php" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="itemName">Item Name:</label>
                                <input type="text" class="form-control" id="itemName" name="itemName" required>
                                <div class="invalid-feedback">Please enter an item name.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Options:</h3>
                            <div id="optionsContainer" class="d-flex flex-wrap"></div>
<button type="button" class="btn btn-primary mb-3" onclick="addOption()">Add Option</button>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="itemName2">Item Name:</label>
                                <input type="text" class="form-control" id="itemName2" name="itemName2" required>
                                <div class="invalid-feedback">Please enter an item name.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Options:</h3>
                            <div id="optionsContainer2"></div>

                            <button type="button" class="btn btn-primary" onclick="addOption2()">Add Option</button>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
function addOption() {
    const optionsContainer = document.getElementById("optionsContainer");
    const optionInput = document.createElement("input");
    optionInput.type = "text";
    optionInput.classList.add("form-control", "mr-2");
    optionInput.name = "option[]";
    optionsContainer.appendChild(optionInput);
}



function addOption2() {
            const optionsContainer2 = document.getElementById("optionsContainer2");
            const optionInput = document.createElement("input");
            optionInput.type = "text";
                optionInput.classList.add("form-control", "mr-2");
            optionInput.name = "option2[]";
            optionsContainer2.appendChild(optionInput);
        }
        </script>







        <!-- Footer Start -->

        <!-- Footer End -->
        </footer>
        <!-- end of container-->
    </div>





    <?php
    require_once 'admin_config.php';


    $itemName = $_POST['itemName'];
    $itemName2 = $_POST['itemName2'];
    $options = $_POST['option'];
    $options2 = $_POST['option2'];

    // Insert the item into the items table
    $sql = "INSERT INTO items (name) VALUES ('$itemName')";
    if ($conn->query($sql) === TRUE) {
        $itemId = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Insert the options into the options table
    foreach ($options as $option) {
        $sql = "INSERT INTO options (item_id, name) VALUES ($itemId, '$option')";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $sql = "INSERT INTO items (name) VALUES ('$itemName2')";
    if ($conn->query($sql) === TRUE) {
        $itemId2 = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

        // Insert the options into the options table
        foreach ($options2 as $option2) {
            $sql = "INSERT INTO options (item_id, name) VALUES ($itemId2, '$option2')";
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    $conn->close();
?>