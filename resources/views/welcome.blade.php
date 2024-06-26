<form action="">
    @csrf
    @method('post')
    first name
    <input type="text" name="firstName" id=""><br>
    last name
    <input type="text" name="lastName" id=""><br>
    address
    <input type="text" name="address" id=""><br>
    city
    <input type="text" name="city" id=""><br>
    <input type="submit" value="Submit">
</form>
<script>
    $(document).ready(function(){
        $.ajax({
            type: "method",
            url: "url",
            data: "data",
            dataType: "dataType",
            success: function (response) {
                
            }
        });
    });
</script>
