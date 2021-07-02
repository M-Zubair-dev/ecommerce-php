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
  $category=get_safe_value($_POST['category']);
  $order_number=get_safe_value($_POST['order_number']);
  $added_on=date('Y-m-d h:i:s');
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `category` WHERE category= '$category'"))>0){
      $msg="Category already added";
    }else{
        
            if($id==''){
              $sql="SELECT * FROM `category` WHERE category='$category'";
          
            }else{
              $sql="SELECT * FROM `category` WHERE category='$category' and id!='$id'";
            }
                if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
                  $msg="Category already added";
                }else{
                    if($id==''){
                      mysqli_query($conn,"insert into category (category,order_number,status,added_on) value('$category','$order_number',1,'$added_on')");
                        redirect('category.php');
                      }else{
                        mysqli_query($conn,"update category set category='$category',order_number=
                        '$order_number' where id='$id'");
                        redirect('category.php');
                      }
                }
    }
}

if($id==''){
 $sql="SELECT * FROM `category`";
 }else{
 $sql="select * from category where id='$id'";
 }
  //$query="select * from category where id='$id'";
  $run_query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($run_query);
  $result['category'];
  $result['order_number'];

?>
    
    <div class="card">
            <div class="card-body">
            <?=($type=='edit')?'<h4 class="card-title_new center_my">Edit Category</h4>':'<h4 class="card-title_new center_my">Add Categoy</h4>';?>
              <!-- <h4 class="card-title_new">Categoy Master</h4> -->
              <div class="row">
                <div class="col-12">

                    <div class="modal-body">
                      <form method="post">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Category</label>
                          <input type="text" value="<?=$result['category'];?>" class="form-control" name="category" id="recipient-name">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Order Number</label>
                          <input class="form-control"value="<?=$result['order_number'];?>" type="text" name="order_number"id="message-text"></textarea>
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
