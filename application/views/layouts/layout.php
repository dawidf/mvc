<html>
<head>
    <title>MVC - ABC</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/styles/style.css"/>
    <script src="/js/angular.min.js"></script>

</head>
<body>
<div ng-app="">
    <p>Name : <input type="text" ng-model="name"></p>
    <h1>Hello {{name}}</h1>
</div>
<?php print $layout->flashMessage ?>
<?php print $layout->menu ?>
<?php print $layout->message ?>



<?php echo $content; ?>



</body>
</html>