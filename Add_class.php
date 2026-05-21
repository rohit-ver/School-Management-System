<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <form method="POST">
        <h2>Add Class</h2>

        <div class="form-group">
            <label>Class Name</label>
            <input type="text" name="class_name" required>
        </div>

        <div class="form-group">
            <label>Section</label>
            <input type="text" name="section">
        </div>

        <div class="form-group">
            <select name="teacher_id">
                <option value="">Select Teacher</option>

                <!-- PHP loop -->
                <option value="1">Rahul Sir</option>
                <option value="2">Amit Sir</option>

            </select>
        </div>

        <div class="form-group">
            <label>Room Number</label>
            <input type="text" name="room_no">
        </div>

        <button type="submit" name="submit">Add Class</button>
    </form>
</body>

</html>