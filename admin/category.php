<?PHP
include('header.php');
$msg="";
$category="";
$order_number="";
$id="";
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']!==''){
  $type=$_GET['type'];
  $id=$_GET['id'];
  if($type=='delete'){
       mysqli_query($conn,"delete from category where id='$id'");
       redirect('category.php');
  }
  if($type=='active' || $type=='deactive'){
      $status=1;
      if($type=='deactive'){
          $status=0;
      }
      mysqli_query($conn,"update category set status='$status' where id='$id'");
      redirect('category.php');
  }
  if($type=='edit'){

  }

}
// $category=get_safe_value($_POST['']);
    // $order_number=get_safe_value($_POST['']);
// if(isset($_POST['submit'])){
//     $category=get_safe_value($_POST['category']);
//     $order_number=get_safe_value($_POST['order_number']);
//     $added_on=date('Y-m-d h:i:s');

//     if($id==''){
//       $sql="SELECT * FROM `category` WHERE category='$category'";
  
//     }else{
//       $sql="SELECT * FROM `category` WHERE category='$category' and id!='$id'";
//     }
//     if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
//       $msg="Category already added";
//     }else{
//       if($id==''){
//         mysqli_query($conn,"insert into category (category,order_number,status,added_on) value('$category','$order_number',1,'$added_on')");
//            redirect('category.php');
//         }else{
//           mysqli_query($conn,"update category set category='$category',order_number=
//           '$order_number' where id='$id'");
//            redirect('category.php');
//         }

//       }
//     }
//     // if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `category` WHERE category= 
//     // '$category'"))>0){
//     //   $msg="Category already added";
//     // }else{
//     //   if(  $category!="" && $order_number!=""){
//     //     mysqli_query($conn,"insert into category (category,order_number,status,added_on) value('$category','$order_number',1,'$added_on')");
//     //     redirect('category.php');
//     //     }
//     // }



  $query="select * from category order by order_number";
  $run_query=mysqli_query($conn,$query);
?>


<div class="card">
            <div class="card-body">
              <h4 class="card-title_new">Categoy Master</h4>
              <a type="submit" name="submit"href="manage_category.php" class="btn btn-success btn-sm margin1">Add Category</a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th with="10%">S.NO #</th>
                            <th with="35%">Category</th>
                            <th with="10%">Order Number</th>
                            <th with="15">Status</th>
                            <th with="40%">Actions</th>
                        </tr>
                      </thead>
                     
                      <tbody>
                      <?php 
                      
                         if(mysqli_num_rows($run_query)>0){
                             $i=1;
                             while($row=mysqli_fetch_assoc($run_query)){

                
                      ?>
                        <tr>
                            <td wirth><?= $i; ?></td>
                            <td><?= $row['category'] ?></td>
                            <td><?= $row['order_number'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                               <?=($row['status']==1) ? '<a href="?id='.$row['id'].'&type=deactive">
                               <label class="badge badge-success">Active</label>':'<a href="?id='.$row['id'].'&type=active">
                               <label class="badge badge-warning">Dactive</label>'?>
                              
                             <a href="manage_category.php?id=<?=$row['id'];?>&type=edit"><label class="badge badge-info">Edit</label></a>
                             
                             <a href="?id=<?=$row['id'];?>&type=delete"> <label class="badge badge-danger">Delete</label></a>
                            </td>
                           
                        </tr>
                        <?php $i++;
                        }
                        } else {
                        ?> 
                         <tr>
                         
                           <td class="color" colspan="5">NO Data Found</td>
                           <td class="color" colspan="5"></td>
                        </tr>

                        <?php  } 
                        ?>
                      </tbody>
                    </table>
                    <span class="color"><?= $msg;?></span>
                  </div>
				</div>
              </div>
            </div>
          </div>

<?php
include('footer.php');

?>
