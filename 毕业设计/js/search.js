// JavaScript Document



     window.onload=function(){
        var inp=document.getElementsByTagName("input");
        var oP=document.getElementById("box1");

        inp[1].onclick=function(){
            var str = inp[0].value;
            if (!str)return; //若内容不存在即返回
            oP.innerHTML=oP.innerHTML.split(str).join('<span>'+str+'</span>')
        }
    };


