<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="../CIAinn/main.js"></script>
    <title>CIAinn</title>
</head>
<body>

<header>

    <h1><a href="index.html">CIAinn</a></h1>
	
</header>
<hr/>

<section>

<h3>Search Results</h3>
   
    <table >
    <?php foreach ($result as $search): ?>
      <tr>
      <td> <?php echo $search['roomno']; ?> </td>
       <td style= "width:150px"> <?php echo $search['bedsize']; ?> </td>
	   <td> <?php echo $search['noofbeds']; ?> </td>
	   <td> <?php echo $search['noofguests']; ?> </td>
        <td> <?php echo $search['smokingallowed']; ?> </td>
         <td> <?php echo $search['noofbathroom']; ?> </td>
         
      </tr>
    <?php endforeach; ?>
    </table>
   
</section>
</body>
</html>