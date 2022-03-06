
<?php
	include('../database/db_connection.php');
	
	$selectCate = "SELECT * FROM `tbl_category`";
    $runselectCate = mysqli_query($conn,$selectCate);
	if(mysqli_num_rows($runselectCate)>0)
	{
		$i=1;
?>
			<?php
			while($rows = mysqli_fetch_assoc($runselectCate))
					{			
			?>
				<tr>
					<td><?=$i?></td>
					<td><?=$rows['name']?></td>
					<td><?=$rows['description']?></td>
					<td class="text-center">
						<?php
							if($rows['status'] ==1)
							{
						?>
						<a href="#">
							<box-icon name='show' ></box-icon>
						</a>
						<?php
							}
							else
							{
						?>
						<a href="#">
							<box-icon name='hide' ></box-icon>
						</a>
						<?php
							}
						?>
					</td>
					<td class="text-center">
						<a href="#">
							<box-icon name='edit-alt'></box-icon>
						</a>
						<a href="ListData/getDeleteCate.php?id=<?=$rows['cateId']?>" class="deleteCate">
							<box-icon name='trash'></box-icon>
						</a>
					</td>
				</tr>
										
<?php
				$i++;
			}
	}
?>

