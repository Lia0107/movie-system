<?php 

session_start();
session_destroy();
echo "<script>
alert('Logout the account successful!!!');
window.location.href = '../Mainpage/index-2.php';
</script>"; // Redirect to the desired page after deletion
?>