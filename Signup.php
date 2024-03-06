<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="C:\xampp\htdocs\dormitory_management_system\dormitory_management_system\css\signup.css">
  <title>Signup-Page</title>
  <style>
    body {
      background-color: #f8f9fa; 

    }
    .custom-font {
      font-family: 'Peanut Butter'; /* Replace 'Your Font Family' with your desired font */
    }
  </style>
</head>
<body>

<div class="container mt-5 custom-font">
  <div class="row justify-content-center">
    <div class="col-md-6 bg-white p-4 rounded">
      <form>
        <div class="form-group">
        <i class="fa-solid fa-user"></i>
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>
          <select class="form-control" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="profile">Profile</label>
          <div class="input-group">
            <div class="input-group-append">
              <label class="btn btn-outline-secondary">
                Upload Picture <input type="file" style="display: none;">
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Enter your username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
