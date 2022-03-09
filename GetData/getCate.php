<?php
	include('../database/db_connection.php');
	
	$selectCate = "SELECT * FROM `tbl_category` ORDER BY `cateId` DESC limit 5";
    $runselectCate = mysqli_query($conn,$selectCate);
	if(mysqli_num_rows($runselectCate)>0)
	{
?>

			<?php
			while($rows = mysqli_fetch_array($runselectCate))
					{			
			?>
				<tr>
					<td><?=$rows['name']?></td>
					<td><?=$rows['description']?></td>
					<td class="text-center">
						<?php
							if($rows['status'] ==1)
							{
						?>

							<box-icon name='show' ></box-icon>

						<?php
							}
							else
							{
						?>

							<box-icon name='hide' ></box-icon>

						<?php
							}
						?>
					</td>
				</tr>
					
<?php
			}
	}
?>
