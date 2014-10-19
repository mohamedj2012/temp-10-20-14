<!DOCTYPE html>
<html>
<head>
<title>URL NOSH Comment Form</title>
<meta name="keywords" content="URL NOSH, Members, URL evaluation">
<meta name="description" content = "Evaluation form for URLs">
</head>
<body>
<h1>NOSH URL Survey</h1>
<p>Give us your candidate comments about a URL worth consideration.</p>

<section>
<form action ="../controllers/postCommentController.php" method="Post">
URL for Evaluation:<input type="url" name ="evaluationUrl">

<p>
Give us your critique:<br>
<textarea name="comment" placeholder="Your comments go here" rows = "20" cols="60">
</textarea>
</p>
<fieldset>
<legend>This comment addresses:</legend>
<input type="checkbox" name="commentTagList[]" value ="layout">Site layout 
<input type="checkbox" name="commentTagList[]" value ="colors">Color scheme 
<input type="checkbox" name="commentTagList[]" value ="semantics">Semantic organization 
<input type="checkbox" name="commentTagList[]" value ="content">Content 
</fieldset>

<p> Nosh member type:
<input type="radio" name="memberClassName" value = "reader" required>Reader 
<input type = "radio" name="memberClassName" value = "nosher">Nosher 
<input type = "radio" name="memberClassName" value = "moderator">Moderator 
</p>

<p><input type = "submit" name = "submit" value="Submit"></p>
</form>
</section>
</body>
</html>