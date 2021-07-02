<?PHP
include('header.php');
$msg="";
$category="";
$order_number="";
$id="";
$type='';

if(isset($_GET['id'])!='')
{
  $id=$_GET['id'];
  $type=$_GET['type'];
}

if(isset($_POST['submit'])){
  $name=get_safe_value($_POST['name']);
  $mobile=get_safe_value($_POST['mobile']);
  $password=get_safe_value($_POST['password']);
  $added_on=date('Y-m-d h:i:s');
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `delivery_boy` WHERE name= '$name'"))>0){
      $msg="Delivery Boy already added";
    }else{
        
            if($id==''){
              $sql="SELECT * FROM `delivery_boy` WHERE name='$name'";
          
            }else{
              $sql="SELECT * FROM `delivery_boy` WHERE name='$name' and id!='$id'";
            }
                if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
                  $msg="delivery_boy already added";
                }else{
                    if($id==''){
                      mysqli_query($conn,"insert into delivery_boy (name,mobile,password,status,added_on) value('$name','$mobile','$password',1,'$added_on')");
                        redirect('deliveryboy.php');
                      }else{
                        mysqli_query($conn,"update delivery_boy set name='$name',mobile='$mobile',password='$password' where id='$id'");
                        redirect('deliveryboy.php');
                      }
                }
    }
}

if($id==''){
 $sql="SELECT * FROM `delivery_boy`";
 }else{
 $sql="select * from delivery_boy where id='$id'";
 }
  //$query="select * from category where id='$id'";
  $run_query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($run_query);


?>
    
    <div class="card">
            <div class="card-body">
            <?=($type=='edit')?'<h4 class="card-title_new center_my">Edit User</h4>':'<h4 class="card-title_new center_my">Add User</h4>';?>
              <!-- <h4 class="card-title_new">Categoy Master</h4> -->
              <div class="row">
                <div class="col-12">

                    <div class="modal-body">
                      <form method="post">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Name</label>
                          <input type="text" value="<?=$result['name'];?>" class="form-control" name="name" id="recipient-name">
                        </div>

                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Mobile</label>
                          <input class="form-control"value="<?=$result['mobile'];?>" type="text" name="mobile"id="message-text"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Password</label>
                          <input type="password" value="<?=$result['password'];?>" class="form-control" name="password" id="recipient-name">
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
