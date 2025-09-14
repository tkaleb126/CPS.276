<!DOCTYPE html>
<html>
<head>
    <title>Form Project</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="container">
    <form action="#" method="post">
        <br>
        <div class="row">
            <div class="col">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" id ="firstname" name="firstname" class="form-control">
            </div>
            <div class="col">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" id ="lastname" name="lastname" class="form-control">
            </div>
        </div>
        <br>
        <label for="address" class="form-label">Address</label>
        <input type="text" id ="address" name="address" class="form-control">
        <br>
        <div class ="row">
            <div class ="col-md-6">
                <label for="city" class="form-label">City</label>
                <input type="text" id ="city" name="city" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="state" class="form-label">State</label>
                <select id="state" class="form-select">
                <option>Ohio</option>
                <option>Florida</option>
                <option selected>Michigan</option>
                <option>Arizona</option>
                <option>Massachusetts</option>
                </select>
            </div>
            <div class ="col-md-2">
                <label for="zip" class="form-label">Zip</label>
                <input type="text" id ="zip" name="zip" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id ="phone" name="phone" class="form-control">
            </div>
            <div class="col">
                <label for="emailtext" class="form-label">Email</label>
                <input type="text" id ="emailtext" name="emailtext" class="form-control">
            </div>
        </div>
        <br>
        <p>Preferred method of contact</p>
        <br>
        <div class="row">
            <div class="col-md-1">
                <input class="form-check-input" type="radio" id="email" name="contact" value="email">
                <label class="form-check-label" for="email">Email</label>
            </div>
            <div class="col-md-1">
                <input class="form-check-input" type="radio" id="text" name="contact" value="text">
                <label class="form-check-label" for="text">Text</label>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</body>
</html>
