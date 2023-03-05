



anychart.onDocumentReady(function () {

    $('.question_chart').each(function (i, obj) {

        var data = anychart.data.set([
            ["-3", $(this).attr("counter-3")],
            ["-2", $(this).attr("counter-2")],
            ["-1", $(this).attr("counter-1")],
            ["0", $(this).attr("counter0")],
            ["1", $(this).attr("counter1")],
            ["2", $(this).attr("counter2")],
            ["3", $(this).attr("counter3")]
        ]);

        var data2 = anychart.data.set([
            ["-3", $(this).attr("counter4")],
            ["-2", $(this).attr("counter5")],
            ["-1", $(this).attr("counter6")],
            ["0", $(this).attr("counter7")],
            ["1", $(this).attr("counter8")],
            ["2", $(this).attr("counter9")],
            ["3", $(this).attr("counter10")]
        ]);

        var chart = anychart.column();

        //var series = chart.column(data);
        var seriesData_1 = data.mapAs({x: 0, value: 1});
        var seriesData_2 = data2.mapAs({x: 0, value: 1});
        var series = chart.column(seriesData_1);
        var series2 = chart.column(seriesData_2);
        series.name($(this).attr("survey1"));
        series2.name($(this).attr("survey2"));
        series.normal().fill("#45677C", 1);
        series2.normal().fill("#4B7B5D", 1);
        series.stroke(0);
        series2.stroke(0);
        //series.label().disable();

        chart.background({fill: "#E8F4ED"});

        if(i == 0) {
            chart.legend(true);
        }
        //chart.options.legend.display.set(true);
        //chart.options.label.data("test");
        //chart.options.label.fontcolor("#4B7B5D");


        chart.title($(this).attr("data-title"));

        chart.container($(this).attr("id"));


        chart.draw();





    });
    $('.construct').click(function (n, construct) {
        let class_name = $(this).val();

        if($(this).is(':checked')){
            $('.question_chart').each(function (i, obj){
                if($(this).hasClass(class_name)){
                    if($(this).hasClass('d-none')){
                        $(this).removeClass('d-none');
                    }
                    $(this).addClass('need');
                } else{
                    if ($(this).hasClass('need')){
                    }
                    else {$(this).addClass('d-none');}
                }
            });
        } else {
            let $count = 0;
            $('.question_chart').each(function (i, obj){

                if($(this).hasClass(class_name)){
                    $(this).addClass('d-none');
                    $(this).removeClass('need');
                }
                if($(this).hasClass('need')){
                    $count = 1;
                    $(this).removeClass('d-none');

                }
                console.log($count);

            });
            console.log("final count " + $count);
            if ($count == 0) {
                console.log("removing all charts");
                $('.question_chart').each(function (i, obj){
                    $(this).removeClass('d-none');
                });
            }
        }
    });

});

