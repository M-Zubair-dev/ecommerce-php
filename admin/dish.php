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
       mysqli_query($conn,"delete from dish where id='$id'");
       redirect('dish.php');
  }
  if($type=='active' || $type=='deactive'){
      $status=1;
      if($type=='deactive'){
          $status=0;
      }
      mysqli_query($conn,"update dish set status='$status' where id='$id'");
      redirect('dish.php');
  }

}

  $query="SELECT dish.*, category.category FROM dish, category WHERE dish.category_id = category.id order by dish.id desc";
  $run_query=mysqli_query($conn,$query);
?>


<div class="card">
            <div class="card-body">
              <h4 class="card-title_new">dish Master</h4>
              <a type="submit" name="submit"href="manage_dish.php" class="btn btn-success btn-sm margin1">Add dish</a>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th with="10%">S.NO #</th>
                            <th with="35%">Category</th>
                            <th with="10%">Dish</th>                            
                            <th with="35%">Dish Detail</th>
                            <th with="10%">Image</th>                            
                            <th with="10%">Added On</th>
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
                            <td><?= $row['dish'] ?></td>
                            <td><?= $row['dish_detail'] ?></td>
                            <td> <img src="<?php echo site_dish_image.$row['image'] ?>"/></td>
                            <td><?php 
                            $dateStr=strtotime($row['added_on']);
                            echo date ('d-m-Y',$dateStr); 
                            ?></td>
                            <td><?= $row['status'] ?></td>
                            
                            <td>
                               <?=($row['status']==1) ? '<a href="?id='.$row['id'].'&type=deactive">
                               <label class="badge badge-success">Active</label>':'<a href="?id='.$row['id'].'&type=active">
                               <label class="badge badge-warning">Dactive</label>'?>
                              
                             <a href="manage_dish.php?id=<?=$row['id'];?>&type=edit"><label class="badge badge-info">Edit</label></a>
                             
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
