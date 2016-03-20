<html>
<head>
    <title>Extending PHP app using JavaScript</title>
    <link rel="stylesheet" href="./../base.css">
</head>
<body>
<main>
    <header>
        <a href="./../index.html" class="back-link">Back</a>
        <h1>Provide Input</h1>
    </header>
    <h2>Code</h2>
    <pre><?php echo $code; ?></pre>
    <h2>Params</h2>
    <form method="post">
        <label>Name: <input name="name" type="text"></label>
        <label>Score: <input name="score" type="number" step="any"></label>
        <button type="submit">Submit</button>
    </form>
    <h2>Result</h2>
    <pre><?php echo $output; ?></pre>
</main>
</body>
</html>
