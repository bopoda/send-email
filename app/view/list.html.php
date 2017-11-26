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
        <h1>Emails</h1>
        <table class="table">
            <caption>latest emails</caption>
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Attachments</th>
                <th>Succeed</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->emails as $email) : ?>
            <tr>
                <td><?=$email['id'];?></td>
                <td><?=$email['email'];?></td>
                <td><?=$email['name'];?></td>
                <td><?=$email['subject'];?></td>
                <td><?=$email['message'];?></td>
                <td>
                    <?php $attaches = json_decode($email['attachments']); ?>
                    <?php if ($attaches) : ?>
                        <?php foreach ($attaches as $attach) : ?>
                            <a href=""><?=$attach;?></a> <br />
                        <?php endforeach; ?>
                    <?php else : ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?=$email['success'];?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="col-md-8 col-md-offset-1">
            <h3><a href="/">Send Email Form</a></h3>
        </div>
    </div>
</div>
</body>
</html>
