<?php
echo '<h1>TEST PAGE</h1>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= <?php echo URLROOT . "/public/css/flash.css"?> >
    <title>Document</title>
</head>
<body>
    <?php print_r(json_decode($data['viewone']->uniName)) ?>
    <div class="container">
        <input type="text" value="<?php json_decode($data['viewone']->uniName) ?>" id="uniName_01" name="uninames">
    </div>

<script>
    let input = document.querySelector('input[name="uninames"]'); // Get the input element by name
    let values = input.value.split(","); // Get the value of the input
    console.log(values)
//     let container = document.querySelector('.container');

//     values.forEach(v => {
//         let input = document.createElement('input'); // Create a new input element
//         input.value = v; // Set the value of the input
//         container.appendChild(input); // Add the input to the container
// });
</script>

</body>
</html>

 
