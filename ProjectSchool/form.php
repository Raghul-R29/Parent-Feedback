<?php
session_start();
include("connect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            width: 450px;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 20px 35px rgba(0, 0, 1, 0.9);
        }
        .form-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding-bottom: 1rem;
        }
        .input-group {
            margin-bottom: 1rem;
            position: relative;
        }
        label {
            color: black;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }
        input::placeholder{
             color:transparent;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input:focus, textarea:focus {
            border-color: hsl(327, 90%, 28%);
            outline: none;
        }
        .gender-container {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        button {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            background: rgb(125, 125, 235);
            color: white;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background:rgb(36, 3, 142);
        }
        a{
            margin-top: 20px;
            
        }
        .alert{
            color:red;
            font-size:12px;
        }
    </style>

      <script>
        $(document).ready(function(){
          $("#submitbutton").click(function(event) {
                event.preventDefault();
               
                var stdname = $("#stdname").val();
                var stdrno = $("#stdrno").val();
                var stdclass = $("#stdclass").val();
                var gender = $("input[name='gender']:checked").val();
                var parentname = $("#parentname").val();
                var pmobile = $("#pmobile").val();
                var feedback = $("#feedback").val();
               
                var isValid = true;

             
                var nameRegex = /^[A-Za-z\s]{3,}$/;
                if (!nameRegex.test(stdname)) {
                    $('#name').text("StudentName must contain only letters and be at least 3 characters long.")
                    isValid = false;
                }

                var PnameRegex = /^[A-Za-z\s]{3,}$/;
                if (!PnameRegex.test(parentname)) {
                    $('#pname').text("ParentName must contain only letters and be at least 3 characters long.")
                    isValid = false;
                }

                var mobileRegex = /^[0-9]{10}$/;
                if (!mobileRegex.test(pmobile)) {
                    $('#mobile').text("Enter a valid 10-digit mobile number.")
                 
                    isValid = false;
                }

      
                if (!stdname || !stdrno || !stdclass || !parentname || !gender || !parentname || !feedback) {
                    alert("Please fill all the details.");
                    isValid = false;
                }

   
                if (isValid) {
                $.ajax({ 
                url: 'insert.php',
                type: 'POST',
                data: {
                    stdname: stdname,
                    stdrno: stdrno,
                    stdclass: stdclass,
                    gender: gender,
                    parentname:parentname ,
                    pmobile:pmobile,
                    feedback:feedback            
                },
                success: function(data){
                    alert("success");
                    window.location.href = "details.php";

                },
                error: function(error) {
                    console.log(error);
               }
                
        });
    }
      });
    });

    </script>
</head>
<body>
    <div class="container">
        <form action="insert.php" method="POST">
            <h2 class="form-title">Feedback Form</h2>
            <div class="input-group">
                <label for="stdname">Student Name</label>
                <input type="text" id="stdname" name="stdname" placeholder="Enter Name" required>
                <div id="name" class="alert"></div>
            </div>
            <div class="input-group">
                <label for="stdrno">Student Roll Number</label>
                <input type="text" id="stdrno" name="stdrno" placeholder="Enter Roll Number" required>
                
            </div>
            <div class="input-group">
                <label for="stdclass">Student Class</label>
                <input type="text" id="stdclass" name="stdclass" placeholder="Enter Class" required>
            </div>
            <div class="input-group">
                <label>Gender</label>
                <div class="gender-container">
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female" required>
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="other" required>
                    <label for="other">Other</label>
                </div>
            </div>
            <div class="input-group">
                <label for="parentname">Parent Name</label>
                <input type="text" id="parentname" name="parentname" placeholder="Enter Name" required>
                <div id="pname" class="alert"></div>
            </div>
            <div class="input-group">
                <label for="pmobile">Parent Mobile</label>
                <input type="tel" id="pmobile" name="pmobile" placeholder="Enter Number" maxlength=10 required>
                <div  id="mobile" class="alert"></div>
            </div>
            <div class="input-group">
                <label for="feedback">Parent Feedback</label>
                <textarea id="feedback" name="feedback" placeholder="Enter Feedback" required></textarea>
            </div>
            <button type="submit" id="submitbutton">Submit</button>
        </form>
  
        <?php 
       if(isset($_SESSION['email'])){
        $email=$_SESSION['email'];
        $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
        while($row=mysqli_fetch_array($query)){
            echo $row['firstName'].' '.$row['lastName'];
        }
       }
       ?>
      <a href="logout.php">| Logout</a>
     
     
    </div>

</body>
</html>