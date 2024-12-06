<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<h2>Log in</h2>

<form action="" method="post" class="flex flex-col">
    <div class="pb-4">
        <p>Username:</p>
        <input type="text" name="User" maxlength="50" value="" class="validate" required="" aria-required="true" />
    </div>
    
    <div class="pb-4">
        <p>Password:</p>
        <input type="password" name="Pass" maxlength="30" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="cursor">
        <input type="submit" name="submit" value="Login" class="btn" />
    </div>

    <div>
        <a href="index.php?page=newuser" class="secondary-color">Got no user? Create a new user here</a>
    </div>
</form>

<!-- attempting recaptcha -->
<!-- <button class="g-recaptcha" 
        data-sitekey="6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF" 
        data-callback='onSubmit' 
        data-action='submit'>Submit</button> -->


<!-- recaptcha -->
<script src="https://www.google.com/recaptcha/api.js"></script>

<!-- recaptcha -->
<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
</script>

</body>
</html>