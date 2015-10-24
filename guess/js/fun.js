$(function() {
    function RndNum(n) {
        var rnd = "";
        for (var i = 0; i < n; i++)
            rnd += Math.floor(Math.random() * 10);
        return rnd;
    }

    var lotteryListUl = $(".lottery-list-ul li");

    var flag;	//setInterval标志
    var arr = Array();	//数组
    var begin_flag = true;	//初始化开始标志
    var ret;
    var num;
    var max_num; //最大值
    var repeat = true; //是否能重复

    //监听输入事件
    arr = [];
    for (var i = 0; i <= 9; i++) {
        arr.push(i)//循环录入数组
    }
    begin_flag = true;
    //开始
    $("#start").click(function() {
        if (begin_flag) {
            flag = setInterval(rd, 100);
            begin_flag = false;
            lotteryListUl.eq(num).text('?');
            setTimeout(function() {
                clearInterval(flag);
                if (!repeat) no_repeat();
                lotteryListUl.eq(num).text('ok');
                begin_flag = true;
            }, 3000)
        }
    })

    //产生随机数
    function rd() {
        num = arr[Math.floor(Math.random() * arr.length)];	//获得的随机数
        var hundred, figures, theunit;
//        hundred = Math.floor(num / 100);
//        figures = Math.floor(num % 100 / 10);
        theunit = Math.floor(num % 10);
        lotteryListUl.eq(theunit).addClass("cur").siblings().removeClass("cur")
        console.log(theunit)
    }

    //不重复	
    function no_repeat() {
        //alert(num);
        //alert(arr);
        var arr_2 = Array();
        for (var i = 0; i < arr.length; i++) {
            if (arr[i] == num) {
                continue;	//跳过相同
            }
            else {
                arr_2.push(arr[i]);		//放入新的数组
            }
        }
        //alert(arr_2);
        if (arr_2.length == 1) {	//没有数字了
            for (var i = 0; i <= max_num; i++) {
                arr.push(i)//循环录入数组
            }
        }
        else {	//还有数字
            arr = arr_2;
        }
    }

})