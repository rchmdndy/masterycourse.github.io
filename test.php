<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body>
<textarea id="myTextarea"></textarea>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../scripts/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        try {
            $('#myTextarea').summernote();
        } catch (error) {
            console.error("An error occurred while initializing Summernote: ", error);
        }
    });
</script>
</body>
</html>