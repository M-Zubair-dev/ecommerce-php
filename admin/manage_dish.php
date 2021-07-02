<?PHP
include('header.php');
$image_status='required';
$msg="";
$category_id="";
$dish="";
$dish_detail="";
$id="";
$image='';
$type='';
if(isset($_GET['id']) &&  $_GET['id']>0)
{
  $id=$_GET['id'];
  $row=mysqli_fetch_assoc(mysqli_query($conn,"select * from dish where id='$id'"));
  $category_id=$row['category_id'];  
  $dish=$row['dish'];
  $dish_detail=$row['dish_detail']; 
  $image=$row['image'];
  $image_status='';
}

if(isset($_POST['submit'])){
  $category_id=get_safe_value($_POST['category_id']);
  $dish=get_safe_value($_POST['dish']);
  $dish_detail=get_safe_value($_POST['dish_detail']);
  $added_on=date('Y-m-d h:i:s');

   // if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `delivery_boy` WHERE name= '$name'"))>0){
     // $msg="Delivery Boy already added";
   // }else{
        
            if($id==''){
              $sql="SELECT * FROM `dish` WHERE dish='$dish'";
          
            }else{
              $sql="SELECT * FROM `dish` WHERE dish='$dish' and id!='$id'";
            }
                if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
                  $msg="Dish already added";
                }else{
                    if($id==''){
                      $image=$_FILES['image'] ['name'];
                      move_uploaded_file($_FILES['image'] ['tmp_name'],server_dish_image.$_FILES['image']['name']);
                      mysqli_query($conn,"insert into dish (category_id,dish,dish_detail,status,added_on ,image)
                       value('$category_id','$dish','$dish_detail',1,'$added_on','$image')");
                       
                       // redirect('dish.php');
                      }else{
                        $image_condition=''; 
                        if($_FILES['image'] ['name']!=''){
                          $image=$_FILES['image'] ['name'];
                          move_uploaded_file($_FILES['image'] ['tmp_name'],server_dish_image.$_FILES['image']['name']);
                          $image_condition=", image='$image'";
                        }
                        $sql="update dish set category_id='$category_id',dish='$dish',dish_detail='$dish_detail' $image_condition where id='$id'";
                        mysqli_query($conn,$sql);
                       
                      }
                      redirect('dish.php');
                }
    //}      
}

// if($id==''){
//  $sql="SELECT * FROM `delivery_boy`";
//  }else{
//  $sql="select * from delivery_boy where id='$id'";
//  }
//   //$query="select * from category where id='$id'";
//   $run_query=mysqli_query($conn,$sql);
//   $result=mysqli_fetch_assoc($run_query);
$res_category=mysqli_query($conn,"select * from category where status='1' order by category asc");

?>
    
    <div class="card">
            <div class="card-body">
            <?=($type=='edit')?'<h4 class="card-title_new center_my">Edit User</h4>':'<h4 class="card-title_new center_my">Add User</h4>';?>
              <!-- <h4 class="card-title_new">Categoy Master</h4> -->
              <div class="row">
                <div class="col-12">

                    <div class="modal-body">
                      <form method="post"  enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Category</label>
                          <select class="form-control" name="category_id">
                          <option>Select Category</option>
                          <?php
                              while($row_category=mysqli_fetch_assoc($res_category)){

                                // echo "<option value='".$row_category['id']."'>".$row_category['category']."</option>";



                                if($row_category['id']==$category_id){
                                  echo "<option value='".$row_category['id']."' selected >".$row_category['category']." </option>";
                                }else{
                                  echo "<option value='".$row_category['id']."'>".$row_category['category']." </option>";
                               }
                              }
                              

                          ?>
                          </select>
                         
                        </div>

                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">dish</label>
                          <input type="text" value="<?=$dish;?>" class="form-control" name="dish" id="recipient-dish">
                        </div>

                        <div class="form-group">
                          <label for="message-text" class="col-form-label">dish_detail</label>
                          <textarea class="form-control"value="<?=$dish_detail;?>"  name="dish_detail"id="message-text"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Dish Image</label>
                          <input type="file" class="form-control" name="image" <?=$image_status;?> id="recipient-dish">
                        </div>
                        <button type="submit" name="submit" class="btn btn-success btn-sm">Submit</button>
                      </form>
                    </div>
                   <span class="color"><?=$msg?></span>
                </div>
              </div>
            </div>
    </div>
          
       

<?php
include('footer.php');
/*
// if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']!==''){
//  $type=$_GET['type'];
//  $id=$_GET['id'];
//   if($type=='delete'){
//        mysqli_query($conn,"delete from category where id='$id'");
//        //redirect('category.php');
//   }
//   if($type=='active' || $type=='deactive'){
//       $status=1;
//       if($type=='deactive'){
//           $status=0;
//       }
//       mysqli_query($conn,"update category set status='$status' where id='$id'");
//       //redirect('category.php');
//   }
//   if($type=='edit'){
    
//       $category=get_safe_value($_POST['category']);
//       $order_number=get_safe_value($_POST['order_number']);
//       $added_on=date('Y-m-d h:i:s');
  
//       if($id==''){
//         $sql="SELECT * FROM `category` WHERE category='$category'";
    
//       }else{
//         $sql="SELECT * FROM `category` WHERE category='$category' and id!='$id'";
//       }
//       if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
//         $msg="Category already added";
//       }else{
//         if($id==''){
//           mysqli_query($conn,"insert into category (category,order_number,status,added_on) value('$category','$order_number',1,'$added_on')");
//             // redirect('category.php');
//           }else{
//             mysqli_query($conn,"update category set category='$category',order_number=
//             '$order_number' where id='$id'");
//             // redirect('category.php');
//           }
  
//         }
      
//   }

// }
// $category=get_safe_value($_POST['']);
    // $order_number=get_safe_value($_POST['']);

    // if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `category` WHERE category= 
    // '$category'"))>0){
    //   $msg="Category already added";
    // }else{
    //   if(  $category!="" && $order_number!=""){
    //     mysqli_query($conn,"insert into category (category,order_number,status,added_on) value('$category','$order_number',1,'$added_on')");
    //     redirect('category.php');
    //     }
    // }
    */
?>
