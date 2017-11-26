<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Send an email</title>
    <!-- bootstrap minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <!-- bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="/assets/style.css">
<!--    <script src="/assets/sendEmail.js"></script>-->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <h2>Send email form</h2>

            <form role="form" method="POST" id="sendEmailForm" action="/"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="subject"> Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="name" > Name:</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="50">
                </div>
                <div class="form-group">
                    <label for="email" class="required"> Email:</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength="255" required>
                </div>
                <div class="form-group">
                    <label for="name" class="required"> Message:</label>
                    <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Your Message Here" maxlength="4000" rows="7" required></textarea>
                </div>
                <div class="form-group">
                    <label for="name"> Select a file to Upload:</label>
                    <input type="file" class="form-control" name="image[]">
                </div>
                <div class="form-group">
                    <label for="name"> Select a file to Upload:</label>
                    <input type="file" class="form-control" name="image[]">
                </div>
                <input type="submit" class="btn btn-lg btn-info pull-right" id="sendBtn" value="Send!" />
            </form>
        </div>

        <div class="col-md-8 col-md-offset-1">
            <?php if ($this->sendEmail) : ?>
                <div class="text-success">Email send</div>
            <?php endif; ?>
            <?php foreach ($this->errors as $error): ?>
                <div class="text-danger"><?=$error;?></div>
            <?php endforeach; ?>

            <h3><a href="/list">Link to admin panel (list)</a></h3>
        </div>
    </div>
</div>
</body>
</html>
