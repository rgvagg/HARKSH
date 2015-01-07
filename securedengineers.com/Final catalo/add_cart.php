<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add to cart</title>
<?php
include_once("link.php");?>
</head>


<div class="wrap" > 
<?php
include_once("conn.php");
@$user=$_SESSION['idd'];

?>
<?php
require_once "popup.php"; 
?>

<?php
require_once "header.php";
?>
<div style="margin:20px;width:96%; max-width:96%">
                  
<span style="color:#ce0d12;font-size:24px">Your Shopping Cart</span>
<br /><br />
 <table style="border:1px #CCCCCC solid; width:100%;padding:10px;" cellspacing="10px" cellpadding="10px">
 <tr >
   <th style="font-weight:bold;">Image</th>
   <th style="font-weight:bold;">Product Code </th>
   <th style="font-weight:bold;">Product Name</th>
   <th style="font-weight:bold;">Qty </th>
   <th style="font-weight:bold;">Price</th>
   <th style="font-weight:bold;">Delivery Details</th>
   <th style="font-weight:bold;">SubTotal</th>
   <th style="font-weight:bold;">Remove </th>
  
   </tr>
   
   <?php
   if(isset($_SESSION['idd']))
   {
      $sql=mysql_query("select * from add_cart where user_id=".$_SESSION['idd']);
	  $total=0;$count=0;
	  $p="";
	  $rows=mysql_num_rows($sql);
	  
	  while($run=mysql_fetch_array($sql))
	  {
		  echo"<tr><td colspan='8'><br /><hr /><br /> 
   </td></tr>";
		  echo"<tr><th>";
		  $path="Final catalo/latest all products/500 all/".$run['image'];
		  echo "<img src='$path' width=50 height=50 >";
		  echo "</th><th style='vertical-align:middle'>";
		  echo $run['code_name'];
		   echo "</th><th style='vertical-align:middle'>";
		  echo substr($run['item_name'],0,30);
		  echo "</th><th style='vertical-align:middle'>";
		  echo" <form action='save_qty.php?tt=".$run['cart_id']."' method='post'><input type='text' style='width:20px; height:20;' name='quantity' id='quan' value='".$run['quantity']."'/><input type='submit' name='b1' value='save'> </form>
		 
		     <span id='here'></span></th>";
		  echo"<th style='vertical-align:middle'>".$run['price']."</th>";
		  echo"<th style='vertical-align:middle'>FREE</th>";
		  echo"<th style='vertical-align:middle'>Rs ";
		  echo $run['sub_total'];
		  echo"</th>";
		  echo"<th style='vertical-align:middle'><a href='rem_item.php?id=".$run['cart_id']."'><img src='images/Trash.png' width='45' height='45'></a></th></tr>";
		  $total+=$run['sub_total'];
		  $count+=$run['quantity'];
		
		$p=$p.$run['code_name'].",";
		
		
	
	  }
	  }
	?>
        </table>
         
         <br /><hr /><br />
         <div style=" width:500px;float:right; text-align:right;">
         <span style="font-size:15px; font-family:Georgia, 'Times New Roman', Times, serif">Amount Payable :  </span><span style="font-size:15px;">Rs  <?php echo $total; ?></span>
         
        </div>
      <div style="margin-top:-10px; margin-left:15px;width:500px;  ">
        <?php  if(isset($_SESSION['idd'])){
									$sql=mysql_query("select count(*) from add_cart where user_id=".$_SESSION['idd']);
									$row123=mysql_fetch_array($sql);
				  
				  if($row123[0]=='0')  
				  {
				  }
				  else
				  {
				  echo" <a href='payment_process_cod.php?amt=".$total." & qty=".$count." &prod=".$p."'>"; ?>
		<input style="border-radius:7px;width:120px; height:30px; background-color:#ce0d12; color:white;font-size:14px; font-family:Georgia, 'Times New Roman', Times, serif" type='button' value='Cash on Delivery'/></a>
        <?php echo" <a href='payment_process.php?amt=".$total." & qty=".$count." &prod=".$p."'>"; ?>
		<input style="border-radius:7px;width:120px; height:30px; background-color:#ce0d12; color:white;font-size:14px; font-family:Georgia, 'Times New Roman', Times, serif" type='button' value='Card Payment'/></a>
		  <?php }}?>
</div>
</div>
<br/>
<?php
include_once("footer.php");?>
</body></html>