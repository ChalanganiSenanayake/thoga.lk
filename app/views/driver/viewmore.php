
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/thoga.lk/public/stylesheets/driver/viewmore.css">
		<link rel="shortcut icon" href="/thoga.lk/images/thoga.jpg" type="image/x-icon">

    </head>

    <body>
    <?php include("navdriverdashboard.php"); ?>
    <header >
        
        <div class="topic">
            <h1>Order details of Reference No - <mark>   <?php echo $order_id ?>  </mark></h1>
        </div>
        <hr>

    </header> 

    <div class="left" >
        <div class="transbox">  
            <?php
                foreach($view as $keys => $row){
                    $ordid = $row['order_id'];
                    $wght = $row['weight'];
                    $totcost = $row['total_cost'];
                    $odrdate = $row['order_date'];
                    $dt = new DateTime($odrdate);
                    $date = $dt->format('Y-m-d');
                    $pickdate = $row['pickup_date'];
                    $add1= $row['d_addline1'];
                    $add2=$row['d_addline2'];
                    $city=$row['city'];
                    

                }         
                            
            ?>   
            
                    
            Reference No : 
            <div class="address">
            <input type="text"  name="orderid" value="<?php echo $ordid?>" disabled>
            </div>
            <br>

                                 

            Weight             :
            <div class="address">
            <input type="text"  name="weight" value="<?php echo $wght?>" disabled>
            </div>
            <br>


            Total Cost         :
            <div class="address">
            <input type="text"  name="total cost" value="Rs. <?php echo number_format($totcost,2);?>" disabled>
            </div>
            <br>


           

            Order Date          :
            <div class="address">
            <input type="text"  name="order date" value="<?php echo $date?>" disabled>
            </div>
            <br>

            

            Pickup Date          :
            <div class="address">
            <input type="text"  name="pickup date" value="<?php echo $pickdate?>" disabled>
            </div>
            <br>


            Delivery Address  :
             <div class="address">
                <input type="text" name="addline2" value="<?php echo $add1?>" disabled>
                <br> 
                <input type="text" name="addline2" value="<?php echo $add2?>" disabled>
                <br> 
                <input type="text" name="city" value="<?php echo $city?>" disabled>
                <br>   
            </div>          
                          
        </div> 
    </div>  
        
    
    <div class="right" >
        <div class="transbox">      
            <?php
                
                foreach($buyer as $keys => $row){
                $bname=$row['username'];
            ?>

            Buyer Name :
            <div class="address">
            <input type="text" name="buyer name" value="<?php echo $bname?>" disabled>
            </div>
            <br>
                
            <?php } ?>
                   
            <?php
                       
            foreach($res as $keys => $row){
            $dname=$row['username'];

            ?>       
            Driver Name  :
            <div class="address">
            <input type="text" name="driver name" value="<?php echo $dname?>" disabled>  
            </div>
            <br>


            <?php } ?>
            <form action="changestatus" method="post" >
            <input type="hidden" name="orderid" value="<?php echo $ordid?>">
            Order Status  :
            <!-- Update Status   :  -->
            <div class="address">
            <select name="orderstatus">
                <option value="" selected hidden><?php echo ($ordstatus[0]['description']);?></option>
                <option disabled value="0">Upcoming </option>
                <option value="3">Collected from Farmer</option>
                <option value="2">On the way</option>
                <option value="1">Completed</option>
            </select>
            </div>
            <br>
                <button type="submit" name="updatestatus" class="button1">Update Status</button>
            </form>          
                
        </div>
    </div>
     

	
    <div class="bottom">
        <table  align="center">
			
			<tr>
				<th>Item Name</th>
                <th>pickup location</th>
				<th>Unit Price(per Kg)</th>
				<th>Quantity(Kg)</th>
				<th>Sub Total</th>
			</tr>
			
			<?php
                $sum=0;
				
                 foreach($items as $keys => $row){

                   
				?>	
					<tr>
                    <td> <?php echo $row['vege_name'];?></td>
                    <td><button name='viewAddress' class='button1' onclick='openModal(<?php echo $row['details_id']; ?>)'><?php echo $row['city']; ?>🛈 </button></td>
					<td>Rs. <?php echo number_format($row['total_cost'],2);?></td>
					<td><?php echo number_format($row['weight'],2);?></td>
					<td>Rs. <?php echo number_format($row['total_cost']*$row['weight'],2);?></td>
                    </tr>
                <?php
                    $sum=$sum+ $row['total_cost']*$row['weight'];
                ?>
                    <div class="model1" id="myModal<?php echo $row['details_id'] ?>">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal(<?php echo $row['details_id'] ?>)">&times;</span>
                                
                                <div>👨‍🌾 <?php echo $row['firstname']." ".$row['lastname'];?></div>
                                <div>🏠 <?php echo $row['farm_name'];?></div>
                                <br>
                                <div>📍🖂 <?php echo $row['address_line1'];?></div>
                                <div><?php echo $row['address_line2'];?></div>
                                <div><?php echo $row['city'];?></div>
                                <div><?php echo $row['district'];?></div>
                                <div> <?php echo $row['province'];?></div>
                                <div><?php echo $row['zip_code'];?></div>
                                <br>
                                <div>📞 <?php echo $row['contactno1'];?></div>
                                <div>📞 <?php echo $row['contactno2'];?></div>
                               
                                

                        </div>
                    </div>

                    
            <?php
				}
			
			?>
			
        </table>
        <div class="fin">
            
                
            <align=\"right\"> TOTAL  </align>
            <input type="text"  class="advancedSearchTextBox1"   value="Rs. <?php echo number_format($sum,2);  ?>" disabled>
            
            
        </div>
    </div>
    <?php include("footer.php"); ?> 
    
    </body>
</html>

<script>
    function closeModal(id) {
        var mod = document.querySelector("#myModal"+id);
        mod.style.display = 'none';
        
    }

    function openModal(id) {
        var mod = document.querySelector("#myModal"+id);
        mod.style.display = 'block';

    }

    window.onclick = function(event) {
        if (event.target == mod) {
        mod.style.display = "none";
        }
    }
</script>