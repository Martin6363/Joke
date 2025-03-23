<button onclick="topFunction()" @style(['
    display: none;
    position: fixed;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    bottom: 20px;
    right: 30px;
    z-index: 990; 
    border: none; 
    outline: none; 
    background-color: red; 
    color: white; 
    cursor: pointer; 
    padding: 15px; 
    border-radius: 50%; 
    font-size: 18px; 
']) id="myBtn" title="Go to top"><i class="fa-solid fa-angle-up"></i></button>


<script>
    $(document).ready(function() {
        let mybutton = $("#myBtn");
    
        $(document).on('scroll', () => {scrollFunction()});
    
        function scrollFunction() {
            if ($(document).scrollTop() > 20) {
                mybutton.show();
            } else {
                mybutton.hide();
            }
        }
    })

    function topFunction() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    }
</script>