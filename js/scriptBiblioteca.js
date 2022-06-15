        $(document).ready(function(){
        $("#searchButton").click(function(){
            var input = $("#search").val();

                $.ajax({
                    url:"php/liveSearch.php",
                    method:"POST",
                    data:{input:input},

                    success:function(data){
                        $("#searchResults").html(data);
                        var botaoReceita = document.getElementsByClassName("botaoReceita");
                        var desc = document.getElementsByClassName("desc");
                        for(let i = 0; i < botaoReceita.length; i = i + 1 ) {
                            
                            botaoReceita[i].addEventListener("click", (e) => {
                                desc[i].classList.toggle("show-more");
                            })
                        }
                    }
                });
            
        })
    })