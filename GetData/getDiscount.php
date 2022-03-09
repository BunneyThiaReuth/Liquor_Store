<?php
	include('../database/db_connection.php');
	
	$selectDiscount = "SELECT * FROM `tbl_discount` ORDER BY `disID` DESC limit 5";
    $runselectDiscount = mysqli_query($conn,$selectDiscount);
	if(mysqli_num_rows($runselectDiscount)>0)
	{
?>

			<?php
			while($rows = mysqli_fetch_array($runselectDiscount))
					{			
			?>
				<tr>
                    <td><?=$rows['name']?></td>
                    <td><?=$rows['description']?></td>
                    <td><?=$rows['discountPerent']?>%</td>
                    <td><?=$rows['startDate']?></td>
                    <td><?=$rows['endDate']?></td>
                    <td class="text-center">
                        <?php
                            if($rows['status']==1)
                            {
                                echo "<box-icon name='show' ></box-icon>";
                            }
                            else{
                                echo "<box-icon name='hide' ></box-icon>";
                            }
                        ?>
                    </td>
                </tr>
<?php
			}
	}
?>