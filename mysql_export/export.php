<?php  
//export.php  
$connect = mysqli_connect("hostname", "test", "pass", "test");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM employees";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Epmloyee</th>  
                         <th>First Name</th>  
                         <th>Last Name</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
         <td>'.$row["emp_no"].'</td>  
         <td>'.$row["first_name"].'</td>  
         <td>'.$row["last_name"].'</td>  
    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=employees.xls');
  echo $output;
 }
}
?>
