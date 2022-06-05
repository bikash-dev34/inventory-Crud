<?php 
include'dbconnect.php';

if(isset($_POST['btnsave'])){
$pname=$_POST['pitems'];
$price=$_POST['pcost'];

// echo"name".$pname."price".$price;
if(!empty($pname && $price)){
    $insert = $pdo->prepare("INSERT INTO tbl_product(productname,productprice) VALUES(:name,:price)");
    $insert->bindParam(':name',$pname);
    $insert->bindParam(':price',$price);

    $insert->execute();
   

    if($insert->rowCount()){
        echo"Insert success";
    }else{
        echo"fail to insert";
        
    }
}else{
    echo"fields are empty";
}
    
}//this is end of save btn
if(isset($_POST['btnupdate'])){
    $pitemname=$_POST['pitems'];
   $priceitem=$_POST['pcost'];
   $iditem=$_POST['txtid'];
   
   if(!empty($pitemname && $priceitem)){
       $update=$pdo->prepare("update tbl_product set productname=:name,productprice=:price where id=".$iditem);

       $update->bindParam(':name',$pitemname);
       $update->bindParam(':price',$priceitem);

       $update->execute();

       if($update->rowCount()){
           echo"Data updated successfully!!!";
       }else{
           echo"Fail to update";
       }


   }else{
       echo "fields are empty please fill the fields";

   }
    
}
//-----------------code for delete
if(isset($_POST['btndel'])){
    $delete=$pdo->prepare("delete from tbl_product where id =".$_POST['btndel']);
    $delete->execute();
    
    if($delete->rowCount()){
        echo "Delete successfully";
    }else{
        echo 'Delete Fail!!!!';
    }
    
    
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crud app in php</title>
    </head>

    <body>
        <form action="" method="post">

            <!-- <input type="text" name="pitems" placeholder="Product Name"><br><br>
            <input type="text" name="pcost" id="" placeholder="Enter Price">
            <input type="submit" value="Save" name="btnsave" id=""> -->
            <table id="producttable">
                <thead>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php
                    //-------------code for select or retrieve from table
                $select=$pdo->prepare("select * from tbl_product ");
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){
                    echo'
                    <tr>
                     <td>'.$row->id.'</td>
                    <td>'.$row->productname.'</td>
                    <td>'.$row->productprice.'</td>
                    <td> <button type="submit" name="btnedit" value="'.$row->id.'">Edit</button></td>
                    <td> <button type="submit" name="btndel" value="'.$row->id.'">Delete</button></td>
                   </tr>';
                }
                ?>
                    <?php
                //-------------------------------- code for edit data from table
                if(isset($_POST['btnedit'])){
                    $editdata =$pdo->prepare("select * from tbl_product where id =".$_POST['btnedit']);
                    $editdata->execute();
                    if($editdata){
                        $row = $editdata->fetch(PDO::FETCH_OBJ);
                        echo'<p><input type="text" name="pitems" value="'.$row->productname.'" ><br><br>
                        <input type="text" name="pcost"  value="'.$row->productprice.'" ></p>
                        <input type="hidden" name="txtid" value="'.$row->id.'" ></p>
                        <button type="submit" name="btnupdate"">Update</button>
                        <button type="submit" name="btcancel">Cancel</button>';

                    }
                    // print_r($row);

                    

                }else{

                    echo'<p><input type="text" name="pitems" placeholder="Product Name"><br><br>
                  <input type="text" name="pcost" id="" placeholder="Enter Price"></p>
                   <input type="submit" value="Save" name="btnsave" id="">';
                }
                  ?>

                </tbody>

            </table>
        </form>
    </body>

</html>
<hr>
<!-- select  -->
<?php 
// $select=$pdo->prepare("select * from tbl_product ");
// $select->execute();
//   echo"<pre>";
// while($row = $select->fetch(PDO::FETCH_OBJ)){
//     // echo $row[2]."<br>";//FETCH_NUM
//     // echo $row['productname']."<br>";//FETCH_ASSOC
//     // echo $row->productname."<br>";// for FECTCH_OBJ
//     // print_r($row); 
   
// }
// -----------------another way 
// while($row=$select->fetchAll(PDO::FETCH_ASSOC)){
//     echo $row[0]['productname'];
//     // print_r($row);
// }




?>