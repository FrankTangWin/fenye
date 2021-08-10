<?php 
 include 'conn.php';
 $conn=new sqlhelper;
 $shuliang=20;


 $post_page=$_POST['post_page'];
 $panduan=$_POST['panduan'];

 //统计总数
 $sql="select count(user_id) as one from system_user";
 $totle=array("totle"=>$conn->run_one($sql));
 
  switch ($panduan) {
 //上一页
    case "reduce":    
     $pianyi=  $post_page*$shuliang; //计算出偏移 
 $sql="select * from system_user order by user_id desc limit $pianyi, $shuliang";
 //echo $sql;
 $list=$conn->run_list($sql);            
         break;
 //下一页
     case "increase":     
     $pianyi=  $post_page*$shuliang; //计算出偏移
 $sql="select * from system_user order by user_id desc limit $pianyi, $shuliang";
//echo $sql;
 $list=$conn->run_list($sql);   
         break;
//最后一页
  case "end":
$pianyi=  $post_page*$shuliang; //计算出偏移
 $sql="select * from system_user order by user_id desc limit $pianyi, $shuliang";

 $list=$conn->run_list($sql);               
         break;       

     default:
//默认输出所有列表
 $sql="select * from system_user order by user_id desc limit 0,$shuliang";
 $list=$conn->run_list($sql);
 $post_page=1;
         break;
 }
 //输出当前页数
 $post_page=array("post_page"=>$post_page);
 //组合数组
 $arr=array();
 array_push($arr,$totle,$list, $shuliang,$post_page);
 echo json_encode($arr);  
 
?>  