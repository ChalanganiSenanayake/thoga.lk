
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/thoga.lk/public/stylesheets/Farmer/farmer_profile.css">
<link rel="shortcut icon" href="/thoga.lk/images/thoga.jpg" type="image/x-icon">

</head>
<?php
$status = "disabled";
$color = "black";
$method = "";

if(isset($_GET["edit"])){
    $status = "enabled";
    $color = "red";
    $method = "editprofile";
   
    
  
}
if(isset($_GET['error']) && $_GET['error']==1){
    echo"<script>alert('Error Occured!. Try again');</script>";
}


?>

<body>


   <?php include 'navbar_dash.php';?> 

   
    <div class="wrapper">
        <div class="user_pp">
            <!-- img -->
            <img width="300px" src="/thoga.lk/public/uploads/farmerpropics/<?php echo $_SESSION['user'][0]['user_id'].'.jpg'?>" alt="">

            <br><br>
            <form action="updateprofilepic" method="post" enctype="multipart/form-data">
            <input type="file" name="profpic" value="upload image">
            <br>
            <input type="submit" class="button2" value="update picture">    
            </form>

        </div>
        <div class="user_details">
            <!-- user details -->
            <form action="<?php echo $method ?>" method="get">
                <div class="data_wrapper">
                    <label style="color : <?php echo $color ?>" for="">First name</label>
                    <input type="text" <?php echo $status ?> name="fname" value="<?php echo $all['firstname'] ?>"> 
                </div>

                <div class="data_wrapper">
                    <label style="color : <?php echo $color ?>" for="">Last name</label>
                    <input type="text" <?php echo $status ?> name="lname" value="<?php echo $all['lastname'] ?>" >
                </div>

                <div class="data_wrapper">
                    <label style="color : <?php echo $color ?>" for="">Email Adress</label>
                    <input type="text" name="email" disabled value="<?php echo $all['email'] ?>">
                </div>

                <div>
                    <br>
                    <label for="">Contact Numbers</label>

                </div>

                <div class="data_wrapper adress_data">
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Mobile number</label>
                        <input type="text" name="mobileno1" <?php echo $status ?> value="<?php echo $all['contactno1'] ?>">

                    </div>
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Mobile number</label>
                        <input type="text" name="mobileno2" <?php echo $status ?> value="<?php echo $all['contactno2'] ?>">

                    </div>
                </div>
                <div>
                    <br>
                    <label for="">Location</label>

                </div>

                <div class="data_wrapper adress_data">
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Address line 1</label>
                        <input type="text" name="addr1" disabled value="<?php echo $all['address_line1'] ?>">
                    </div>
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Address line 2</label>
                        <input type="text" name="addr2" disabled value="<?php echo $all['address_line2'] ?>">
                    </div>

                </div>




                <div class="data_wrapper adress_data">
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Farm Name</label>
                        <input type="text" name="farmname" disabled value="<?php echo $all['farm_name'] ?>">

                    </div>
                    <div>
                        <label style="color : <?php echo $color ?>" for="">District</label>
                        <input type="text" name="district" disabled value="<?php echo $all['district'] ?>">

                    </div>
                </div>
                
                
                <div class="data_wrapper adress_data">
                    <div>
                        <label style="color : <?php echo $color ?>" for="">City</label>
                        <input type="text" name="city" disabled value="<?php echo $all['city'] ?>">
                    </div>

                    <div>
                        <label style="color : <?php echo $color ?>" for="">zip code</label>
                        <input type="text" name="zip" disabled  value="<?php echo $all['zip_code'] ?>">
                    </div>
                    
                </div>
                <div class="data_wrapper adress_data">
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Nearest City 1</label>
                        <input type="text" name="nr1" disabled  value="<?php echo $all['NS1'] ?>">
                    </div>
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Nearest City 2</label>
                        <input type="text" name="nr2" disabled  value="<?php echo $all['NS2'] ?>">
                    </div>

                </div>

                <div>
                    <br>
                    <label for="">Mentor</label>

                </div>

                <div class="data_wrapper adress_data">
                    <div>
                        <label style="color : <?php echo $color ?>" for="">Mentor Name</label>
                        <input type="text" name="nr1" disabled  value="<?php echo isset($mentor['username'])?$mentor['username']:'No mentor.';?>">
                        <br>
                        <br>
                        <a class= "dele" href="removementor?fid=<?php echo $fid; ?>" >Unassign Mentor</a>

                    </div>
                </div>

                <hr>
                <br>
                <?php 
                if(isset($_GET['edit'])){
                    echo "<button type='submit' id='myBtn' name='cancel'>Cancel</button>";
                }else{
                    echo "<button type='submit' id='myBtn' name='edit'>Edit</button>";
                }
                ?>
                
                <button type='submit' name='update' class='updt_btn' <?php echo $status ?>>Update</button>


            </form>
            <button type='button' name='update' class='updt_btn' style="width:160px"  onclick='openModal()'>Update Password</button>

        </div>

        
        <div class="model1" id="myModal">
                    <div class="modal-content" style="height:280px;">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <form action="changepwd" style="float:left" method="POST" autocomplete="new-password"  >
                            <input type="hidden" value="<?php echo $all['user_id']?>" name="id">
                            Current Password          : 
                            <input type="password" style="width:60%"  name="currentpwd" required >
                            <br>
                            New Password          : 
                            <input type="password" style="width:60%"  name="newpwd" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\w\W]{8,}$">
                            <br>
                            
                            Confirm New Password          : 
                            <input type="password"  name="confirmpwd" style="width:60%" required  >
                            <br>
                            <center>
                                <span>password should contain minimum 8 characters and with Digits and Letters including Capital Letter</span>
                                <br>
                                <button type='submit' name='changepwd' method="post" class='updt_btn'>Submit</button>
                                <br>
                            </center>
                        </form>   
                    </div>
                </div>

    </div>

    <h1 align="center">Order History</h1>
    <hr>

    <div class="container">
        <!-- order history -->
        <table>

            <thead>
                <tr>
                <th scope="col">Order id</th>
                <th scope="col">Pickup date</th>
                <th scope="col">Total weight</th>
                <th scope="col">Total Price</th>
                <th scope="col">Buyer Name</th>
                <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $key => $values){
            $ordid= $values['order_id'];
            $pdate= $values['pickup_date'];
            $tweight= $values['weight'];
            $cost= $values['total_cost'];
            $bname= $values['b_name'];
            



            
            ?>
            <tr>
            <form action='/thoga.lk/farmer/farmer_viewmore' method='post'>
                <td data-label="Order id"><?php echo $ordid;?></td>
                <td data-label="Pickup date"><?php echo $pdate;?></td>
                <td data-label="Total Weight"><?php echo number_format($tweight,2);?> kg</td>
                <td data-label="Total Price">Rs. <?php echo number_format($cost,2);?></td>
                <td data-label= "Buyer Name"><?php echo $bname;?></td>
                <td>
                    <a class = "more" href="viewmore?id=<?php echo $ordid;?>" > View More </a>
                </td>
                
            </form>
            </tr>

                
            </tbody>
            <?php }?>

        </table>


    </div>
    

    </body>

<script>
    var upBtn = document.getElementById("upBtn");
    var btn = document.getElementById("myBtn");

    btn.onclick = function() {
        upBtn.style.display = "block";
        btn.style.display = "none";
    }


    function closeModal() {
        var mod = document.querySelector("#myModal");
        mod.style.display = 'none';
        
    }

    function openModal() {
        var mod = document.querySelector("#myModal");
        mod.style.display = 'block';

    }

    window.onclick = function(event) {
        if (event.target == mod) {
        mod.style.display = "none";
        }
    }
</script>

</html>