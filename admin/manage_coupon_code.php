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
  $coupon_code=get_safe_value($_POST['coupon_code']);
  $coupon_type=get_safe_value($_POST['coupon_type']);
  $coupon_value=get_safe_value($_POST['coupon_value']);  
  $cart_min_value=get_safe_value($_POST['cart_min_value']);
  $expired=get_safe_value($_POST['expired']);
  $added_on=date('Y-m-d h:i:s');
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `coupon_code` WHERE coupon_code= '$coupon_code'"))>0){
      $msg="<div class='alert alert-success' role='alert'>Coupon already added</div>";
    }else{
        
            if($id==''){
              $sql="SELECT * FROM `coupon_code` WHERE coupon_code='$coupon_code'";
          
            }else{
               $sql="SELECT * FROM `coupon_code` WHERE coupon_code='$coupon_code' and id!='$id'";
            
            }
                if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
                  $msg="<div class='alert alert-success' role='alert'>Coupon Already Added</div>";
                }else{
                    if($id==''){
                      mysqli_query($conn,"insert into coupon_code (coupon_code,coupon_type,coupon_value,cart_min_value,expired,status,added_on) value('$coupon_code','$coupon_type','$coupon_value','$cart_min_value','$expired',1,'$added_on')");
                       // redirect('coupon_code.php');
                      }else{
                        mysqli_query($conn,"update coupon_code set coupon_code='$coupon_code',coupon_type='$coupon_type',coupon_value='$coupon_value',cart_min_value='$cart_min_value',expired='$expired' where id='$id'");
                       // redirect('coupon_code.php');
                      }
                }
    }
}

if($id==''){
$sql="SELECT * FROM `coupon_code`";
 }else{
 $sql="SELECT * FROM `coupon_code` where id='$id'";
 }
   $query="select * from category where id='$id'";
  $run_query=mysqli_query($conn,$sql);
  $result=mysqli_fetch_assoc($run_query);


?>
    
    <div class="card">
            <div class="card-body">
            <?=($type=='edit')?'<h4 class="card-title_new center_my">Edit Coupon Code</h4>':'<h4 class="card-title_new center_my">Add Coupon Code</h4>';?>
              <!-- <h4 class="card-title_new">Categoy Master</h4> -->
              
                    <?=$msg;?>
                    
              <div class="row">
                <div class="col-12">

                    <div class="modal-body">
                      <form method="post">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Coupon Code</label>
                          <input type="text" value="<?=$result['coupon_code'];?>" class="form-control" name="coupon_code" id="recipient-name">
                        </div>

                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Coupon Type</label>
                          <select name="coupon_type" required class="form-control">
                          <option value="">Select Type</option>
                          <?php
                          $arr=array('P'=>'Percentage','F'=>'Fixed');
                          foreach($arr as $key=>$val){ 
                           if($key==$result['coupon_type']){
                             echo "<option value='".$key."' selected >".$val." </option>";
                           }else{
                             echo "<option value='".$key."'>".$val." </option>";
                          }
                           // echo "<option value='".$key."' selected >".$val." </option>";
                          }
                          ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Coupon Value</label>
                          <input type="text" value="<?=$result['coupon_value'];?>" class="form-control" name="coupon_value" id="recipient-name">
                        </div> <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Cart Min Value</label>
                          <input type="text" value="<?= ($id=='') ? '':$result['cart_min_value'];?>" class="form-control" name="cart_min_value" id="recipient-name">
                        </div>

                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Expired</label>
                          <input class="form-control"value="<?=$result['expired'];?>" type="text" name="expired"id="message-text"></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-success btn-sm toastsDefaultMaroon">Submit</button>
                      </form>
                    </div>

                  
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
<script>
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

</script>
