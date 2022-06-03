const botaoReceita = document.getElementsByClassName("botaoReceita");
const desc = document.getElementsByClassName("desc");

    for(let i = 0; i < botaoReceita.length; i = i + 1 ) {
        botaoReceita[i].addEventListener("click", (e) => {
            desc[i].classList.toggle("show-more");
        })
    }

    $(document).ready(function(){
        $("#live_search").keyup(function(){
            var input = $(this).val();

            if(input != ""){
                $.ajax({
                    url:"php/liveSearch.php",
                    method:"POST",
                    data:{input:input},

                    success:function(data){
                        $("#searchResults").html(data);
                    }
                });
            }else{
                $("#searchresult").css("display","none");
                }
        })
    })