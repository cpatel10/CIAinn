<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <title>CIAinn</title>
</head>

<body>
    <div class="container">
        <div class="page-header row">
            <a href="index.php">CIAinn</a>
        </div>

        <div class="row">
            <h3>Search Results</h3>
        </div>

        <div class="row">
            <table class="table">
                <?php foreach ($result as $search): ?>
                <tr>
                    <td><?php echo $search['roomno']; ?> </td>
                    <td style= "width:150px"> <?php echo $search['bedsize']; ?> </td>
                	<td><?php echo $search['noofbeds']; ?> </td>
                	<td><?php echo $search['noofguests']; ?> </td>
                    <td><?php echo $search['smokingallowed']; ?> </td>
                    <td><?php echo $search['noofbathroom']; ?> </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
