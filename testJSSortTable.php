<!doctype html>
<html>
	<head>
		<?php require("initBootstrap.php");?>
		<style type="text/css">
			table thead tr th:hover{
				cursor: pointer;
			}
		</style>
		<script type="text/javascript">
			function testSort(){
				var nrows = testTable.rows.length;
				var ncol = testTable.rows.item(0).cells.length;
				for(var i=0; i<nrows; i++){
					for(var j=0; j<nrows-i-1; j++){
						if(Number(testTable.rows.item(i).cells.item(j)) < Number(testTable.rows.item(i).cells.item(j+1))){
							var row = (this);
 							var sibling = row.nextElementSibling;
 							var parent = row.parentNode;
							parent.insertBefore(sibling, row);
						}
					}
				}
			}
		</script>
	</head>
	<body>
		<table class="table" id="testTable">
			<thead>
				<tr>
				<th id="id" onclick="testSort()">id</th>
				<th id="name" onclick="">Name</th>
				<th id="price" onclick="">Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>Chinmay</td>
					<td>10000</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Rahul</td>
					<td>1000</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Pratik</td>
					<td>10</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>




 