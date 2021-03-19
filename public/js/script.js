    function likeIt(postId){
          $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/like/'+postId,
                success: function (data) {
                  if(data[0]==1){
                    $('#like'+postId).css('color', 'red')
                  }
                  else{
                    $('#like'+postId).css('color', 'black')
                  }

                        $.ajax({
                            type: 'GET', //THIS NEEDS TO BE GET
                            url: '/getlike/'+postId,
                            success: function (result) {
                               console.log(result)
                               if (result==0) {
                                    $('#likess').html('')
                                   
                               } 
                               else if (result==1){
                                    $('#likess').html(' '+result+ '<a href="/likers/'+postId+ '"  style="color:black">  like</a>')
                                   
                               }
                               else{
                                    $('#likess').html(' '+result+ '<a href="/likers/'+postId+ '" style="color:black">  <b>likes</b></a>')
                                   
                               }
                                
                            },
                            error: function(error) { 
                                console.log("error");
                            }
                        });
                    
                },
                error: function(error) { 
                    console.log("error");
                }
            });
    }    

        function search(){
            
            var x= $("#search").val();
            var output= ''
            if (x=='') {
                var x='1'
            }
            else{
                x=$("#search").val()
            }
            
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/search/'+x,
                success: function (data) {
                   var result = JSON.parse(JSON.stringify(data))
                    $('#result').empty();
                  
                    for(i in result){
                        if(result.length==''){
                             $("#result").append("");

                        }
                       
                            else{



                               
                                 if (result[i]['profile']['image']=='') {
                                       
                                         var image='images/faceless.png'
                                 }
                                 else if(result[i]['profile']['image']==null){
                                        var image='images/faceless.png'
                                 
                                 }
                                else{
                                      var image=result[i]['profile']['image']
                                }

                                console.log(image)
                                $("#result").append(
                                    '<div  class="d-flex align-items-center">'+
                                    '<div class="pr-3">'+
                                    '<a href="/profile/' +result[i]['id']+ '" style="text-decoration:none">'+
                                    '<img src="'+ image + '" class="rounded-circle w-100" style="max-width:40px"></a>'+


                                    ' </div>'+
                                    '<div>'+
                                    '<div class="font-weight-bold">'+
                                    '<a href="/profile/' +result[i]['id']+ '" style="text-decoration:none">'+
                                    '<span class="text-dark">'+result[i]['name']+'</span>'+
                                    '<span class="badge btn btn-success ml-5">view profile</span>'+
                                    '</a> </div></div></div><hr>'
                                );
                        
                            }
                    }
                
                },
                error: function(error) { 
                    console.log("error");
                }
            });

        
    }

// enter button posts comments
$("#textarea").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#postComment").click();
    }
});

    function comment(postId){
        var x= $("#textarea").val()
        if (x=='') {
                x=1
            }
            else{
                x=$("#textarea").val()
            }
         $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/comment/'+postId+'/'+x,
                success: function (data) {
                    
                   if (data=='') {
                       console.log('null')
                   }
                   else{
                       // starts here
                                                  
                            $('#textarea').val('')
                            var result = JSON.parse(JSON.stringify(data))
                            //clearing what is in comment space and replacing it with comment and users
                            $('#commentSpace').html('')
                            for(i in result){
                                
                            if (result[i]['user']['profile']['image']=='') {
                                       
                                 var image='images/faceless.png';
                            }
                            else if(result[i]['user']['profile']['image']==null){
                                var image='images/faceless.png';    
                            }
                            
                            else{
                                var image=result[i]['user']['profile']['image'];  
                            }

                            
                            console.log(result)    
                            $('#commentSpace').append(
                                '<p>'+
                                '<a href="/profile/' +result[i]['id']+ '" style="text-decoration:none">'+
                                    '<img src="'+image+ '" class="rounded-circle w-100" style="max-width:40px"></a>'+
                                    '<span class="font-weight-bold ml-4" id="username">'+
                                        '<a href="/profile/'+result[i]['user']['id']+ '"style="text-decoration:none">'+
                                            '<span class="text-dark">'+result[i]['user']['username']+'  '+'</span>'+
                                        '</a>'+ ' '+
                                    '</span>'+result[i]['comment']+
                                    '<br><span class="text-muted mt-3">'+result[i]['created_at']+'</span>'+
                                    
                                        
                                '</p>'
                            )
                            }

                       // ends here 
                   }

                    $.ajax({
                            type: 'GET', //THIS NEEDS TO BE GET
                            url: '/getComments/'+postId,
                            success: function (data) {
                                
                                
                                $('#NoOfComments').text(' '+data)
                            },
                            error: function(error) { 
                                console.log("error");
                            }
                        });
                    
                    
                },
                error: function(error) { 
                    console.log("error");
                }
            });

    }























