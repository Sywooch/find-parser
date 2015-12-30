/**
 * Created by Администратор on 01.12.2015.
 */
$(document).ready(function(){
    $(".phone").hide();
    $(".comp").hide();
    $(".audio-video").hide();
    $(".home").hide();
    $(".game").hide();
    $(".care").hide();
    $('.electronic').hide();
    $('.transport').hide();
    $('.property').hide();
    $('.leisure').hide();
    $('.business').hide();
    $('.jobs').hide();
    $('.tv-disp').hide();
    $('.tv-brand').hide();
    $('.foto-type').hide();
    $('.climate-type').hide();
    $('.comp-display').hide();
    $('.comp-processor').hide();
    $('.comp-os').hide();
    $('.comp-ozu').hide();
    $(".comnats").hide();
    $(".area").hide();
    $(".commerce").hide();
    $(".zapchasti").hide();
    $(".cars").hide();
    $(".ps-type").hide();
    $('.cat-forms').css('background', 'none');
    $('#slogan').show("slow");
    $('.proizv-climate').hide();
    $(".photocam").hide();
    $(".videocam").hide();
    $(".videoregister").hide();
    $(".photoacc").hide();

    $("#sub_cat").change(function(){
        if($(this).val() !== "1"){
            $(".phone").hide();
            $(".phone-options").hide();

        }
        else {
            $(".phone").show("slow");
            $(".phone-options").hide();
            $(".phone-types").change(function() {

                if($(this).val() !== "smartphone" && $(this).val() !== "mob_phone") {
                    $(".phone-options").hide();

                }
                else{
                    $(".phone-options").show("slow");
                    //alert('sac');
                }
            });
        }
        if($(this).val() !== "2"){
            $(".comp").hide();
        }
        else {
            $(".comp").show("slow");
            $(".comp-display").hide();
            $(".comp-processor").hide();
            $(".comp-os").hide();
            $(".comp-ozu").hide();
            $("#comp-type").change(function () {
                if ($(this).val() !== "noutbuk" && $(this).val() !== "planshet" && $(this).val() !== "nast_comp") {
                    $(".comp-display").hide();
                    $(".comp-processor").hide();
                    $(".comp-os").hide();
                    $(".comp-ozu").hide();
                    if ($(this).val() === "monitors") {
                        $(".comp-display").show("slow");
                    }
                }
                else {
                    $(".comp-display").show("slow");
                    $(".comp-processor").show("slow");
                    $(".comp-ozu").show("slow");
                    $(".comp-os").show("slow");
                }
            });
        }
        if($(this).val() !== "3"){
            $(".audio-video").hide();

        }
        else {

            $(".audio-video").show("slow");
            $(".type0").hide();
            $(".type1").hide();
            $(".type2").hide();
            $(".type3").hide();
            $(".type4").hide();
            $(".option1").hide();
            $("#av-type").change(function(){
                if($(this).val() !== "headphones") {
                    $(".type0").hide()
                }
                else{
                    $(".type0").show("slow")
                }
                if($(this).val() !== "mp3-player") {
                    $(".option1").hide()
                }
                else{
                    $(".option1").show("slow")
                }
                if($(this).val() !== "kinoteatr") {
                    $(".type1").hide();
                    $(".type2").hide();
                    $(".type3").hide()
                }
                else{
                    $(".type1").show("slow");
                    $(".type2").show("slow");
                    $(".type3").show("slow")
                }
                if($(this).val() !== "media-player") {
                    $(".type4").hide();
                }
                else{
                    $(".type4").show("slow");
                }
            });

        }
        if($(this).val() !== "4"){
            $(".home").hide();
        }
        else {
            $(".home").show("slow");
            $(".fridge-type").hide();
            $(".fridge-system").hide();
            $(".washer-type").hide();
            $(".washer-system").hide();
            $(".cleaner-type").hide();
            $(".cleaner-power").hide();
            $(".plate").hide();
            $(".plate-type").hide();
            $(".plate-system").hide();
            $(".microwave").hide();
            $(".microwave-type").hide();
            $(".microwave-system").hide();
            $("#home-type").change(function() {
                if ($(this).val() !== "fridges") {
                    $(".fridge-type").hide();
                    $(".fridge-system").hide();
                }
                else {
                    $(".fridge-type").show("slow");
                    $(".fridge-system").show("slow");
                }
                if ($(this).val() !== "washers") {
                    $(".washer-type").hide();
                    $(".washer-system").hide();
                }
                else {
                    $(".washer-type").show("slow");
                    $(".washer-system").show("slow");
                }
                if ($(this).val() !== "pilesosi") {
                    $(".cleaner-type").hide();
                    $(".cleaner-power").hide();
                }
                else {
                    $(".cleaner-type").show("slow");
                    $(".cleaner-power").show("slow");
                }
                if ($(this).val() !== "pliti") {
                    $(".plate").hide();
                    $(".plate-type").hide();
                    $(".plate-system").hide();
                }
                else {
                    $(".plate").show("slow");
                    $(".plate-type").show("slow");
                    $(".plate-system").show("slow");
                }
                if ($(this).val() !== "microwave") {
                    $(".microwave").hide();
                    $(".microwave-type").hide();
                    $(".microwave-system").hide();
                }
                else {
                    $(".microwave").show("slow");
                    $(".microwave-type").show("slow");
                    $(".microwave-system").show("slow");
                }
            });
        }
        if ($(this).val() !== "5") {
            $(".game").hide();
            $(".ps-type").hide();
        }
        else {
            //$(".game").show("slow");
            $(".ps-type").show("slow");
            //$("#game-type").change(function () {
            //    if ($(this).val() == "0" || $(this).val() == "3") {
            //        $(".ps-type").show("slow");
            //
            //    }
            //    else {
            //        $(".ps-type").hide();
            //    }
            //});
        }
        if($(this).val() !== "6"){
            $(".care").hide();
        }
        else {
            $(".care").show("slow");
            $(".shave").hide();
            $(".shave-brand").hide();
            $(".shave-battery").hide();
            $(".shave-type").hide();
            $(".shearer-type").hide();
            $(".epilator-type").hide();
            $("#care-type").change(function () {
                if ($(this).val() !== "0"){
                    $(".shave").hide();
                    $(".shave-brand").hide();
                }
                else {
                    $(".shave").show("slow");
                    $(".shave-brand").show("slow");
                    $(".shave-battery").hide();
                    $("#shave-type").change(function () {
                        if ($(this).val() !== "0"){
                            $(".shave-type").hide();
                        }
                        else {
                            $(".shave-type").show("slow");
                            $(".shave-battery").show("slow");
                        }
                        if ($(this).val() !== "1"){
                            $(".epilator-type").hide();
                        }
                        else {
                            $(".epilator-type").show("slow");
                            $(".shave-battery").show("slow");
                        }
                        if ($(this).val() !== "2"){
                            $(".shearer-type").hide();
                        }
                        else {
                            $(".shearer-type").show("slow");
                            $(".shave-battery").show("slow");
                        }

                    });
                }

            });

        }
        if($(this).val() !== "68"){
            $('.tv-disp').hide();
            $('.tv-brand').hide();
        }
        else {
            $('.tv-disp').show("slow");
            $('.tv-brand').show("slow");
        }
        if($(this).val() !== "69"){
            $('.foto-type').hide();
            $(".photocam").hide();
            $(".videocam").hide();
            $(".videoregister").hide();
            $(".photoacc").hide();

        }
        else {
            $('.foto-type').show("slow");
            $(".photocam").show("slow");
        }
        if($(this).val() !== "70"){
            $('.climate-type').hide();
            $('.proizv-climate').hide();
        }
        else {
            $('.climate-type').show("slow");
            $('.proizv-climate').show("slow");
        }
    });

    $("#sub_cat_prop").change(function(){
        //if($(this).val() !== "18") {
        //    $(".comnats").hide();
        //}
        //else{
        //    $(".comnats").show("slow");
        //}

        switch ($(this).val()){
            case "19":
                $(".comnats").hide();
                $(".area").show("slow");
                $(".commerce").hide();
                break;
            case "21":
                $(".comnats").hide();
                $(".area").show("slow");
                $(".commerce").hide();
                break;
            case "24":
                $(".comnats").hide();
                $(".area").show("slow");
                $(".commerce").hide();
                break;
            case "25":
                $(".comnats").hide();
                $(".area").show("slow");
                $(".commerce").show("slow");


                break;
            case "71":
                $(".comnats").hide();
                $(".area").show("slow");
                $(".commerce").hide();
                break;
            case "18":
                $(".area").hide();
                $(".comnats").show("slow");
                $(".commerce").hide();
                break;
            case "23":
                $(".area").hide();
                $(".comnats").show("slow");
                $(".commerce").hide();
                break;
            case "22":
                $(".area").hide();
                $(".comnats").hide();
                $(".commerce").hide();
                break;
            case "26":
                $(".area").hide();
                $(".comnats").hide();
                $(".commerce").hide();
                break;
            case "20":
                $(".area").hide();
                $(".comnats").hide();
                $(".commerce").hide();
                break;

        }

    });
});
$("#categories").change(function(){
    if ($(this).val() == '10'){
        $(".zapchasti").show("slow");
        $(".cars").hide();
    }
    else{
        $(".cars").show("slow");
        $(".zapchasti").hide();
        $.ajax({
            url: "http://api.auto.ria.com/categories/" + $(this).val() + "/marks",
            dataType: 'json',
            type: 'GET',
            success: function(response){

                $("#marks").empty();
                $("#models").empty();
                $("#models").append("<option value='0'>Модель</option>");
                $("#marks").append("<option value='0'>Марка</option>");
                response.forEach(function(item){
                    $("#marks").append("<option value='" + item['value'] + "'>" + item['name'] + "</option>");
                });

            }
        })

    }
});

$("#marks").change(function(){
    $.ajax({
        url: "http://api.auto.ria.com/categories/" + $("#categories").val() + "/marks/" + $(this).val() + "/models",
        dataType: 'json',
        type: 'GET',
        success: function(response){

            $("#models").empty();
            $("#models").append("<option value='0'>Модель</option>");
            response.forEach(function(item){
                $("#models").append("<option value='" + item['value'] + "'>" + item['name'] + "</option>");
            });

        }
    })
});

$("#subcategory-options-foto-type").change(function(){
    if ($(this).val() == 'Фотокамеры и комплектующие'){
        $(".photocam").show("slow");
        $(".videocam").hide();
        $(".videoregister").hide();
        $(".photoacc").hide();
    }
    if ($(this).val() == 'Видеокамеры и аксессуары'){
        $(".photocam").hide();
        $(".videocam").show("slow");
        $(".videoregister").hide();
        $(".photoacc").hide();

    }
    if ($(this).val() == 'Проекционное оборудование'){
        $(".photocam").hide();
        $(".videocam").hide();
        $(".videoregister").show("slow");
        $(".photoacc").hide();
    }
    if ($(this).val() == 'Аксессуары'){
        $(".photocam").hide();
        $(".videocam").hide();
        $(".videoregister").hide();
        $(".photoacc").show("slow");

    }

});
$('#category1').on('click touchstart touchend',function(){
    $('.cat-forms').css('background', 'rgba(170, 162, 166, 0.7)');
    //var click =  true;
    //console.log(click);
    //if(click==true){
    //    click = false;
    //    click_on.call(this);
    //    console.log(click);
    //
    //} if(click==false) {
    //    click = true;
    //    click_off.call(this);
    //}
    //function click_on()
    //{
    //    console.log('on');

    //$('.electronic').animate({left: 200, opacity: "show"}, 1500);
    $('.electronic').show("slow");
    $('#slogan').hide();
    $('.transport').hide();
    $('.property').hide();
    $('.leisure').hide();
    $('.business').hide();
    $('.jobs').hide();
    //}
    //function click_off()
    //{
    //    console.log('off');
    //    $('.electronic').hide();
    //    $('#slogan').animate({left: 200, opacity: "show"}, 1500);
    //    $('.transport').hide();
    //    $('.property').hide();
    //    $('.leisure').hide();
    //    $('.business').hide();
    //}

});
$('#category2').on('click touchstart touchend',function(){
    $('.cat-forms').css('background', 'rgba(170, 162, 166, 0.7)');
    $('.electronic').hide();
    $('.property').hide();
    $('.leisure').hide();
    $('.business').hide();
    $('.jobs').hide();
    $('.transport').show("slow");
    $('#slogan').hide();

});
$('#category3').on('click touchstart touchend',function(){
    $('.cat-forms').css('background', 'rgba(170, 162, 166, 0.7)');
    $('.electronic').hide();
    $('.transport').hide();
    $('.leisure').hide();
    $('.business').hide();
    $('.jobs').hide();
    $('.property').show("slow");
    $('#slogan').hide();

});
$('#category4').on('click touchstart touchend',function(){
    $('.cat-forms').css('background', 'rgba(170, 162, 166, 0.7)');
    $('.electronic').hide();
    $('.property').hide();
    $('.transport').hide();
    $('.business').hide();
    $('.jobs').hide();
    $('.leisure').show("slow");
    $('#slogan').hide();

});
$('#category5').on('click touchstart touchend',function(){
    $('.cat-forms').css('background', 'rgba(170, 162, 166, 0.7)');
    $('.electronic').hide();
    $('.property').hide();
    $('.transport').hide();
    $('.leisure').hide();
    $('.jobs').hide();
    $('.business').show("slow");
    $('#slogan').hide();

});
$('#category6').on('click touchstart touchend',function(){
    $('.cat-forms').css('background', 'rgba(170, 162, 166, 0.7)');
    $('.electronic').hide();
    $('.property').hide();
    $('.transport').hide();
    $('.leisure').hide();
    $('.business').hide();
    $('.jobs').show("slow");
    $('#slogan').hide();

});

$('.close').on('click touchstart touchend',function(){
    $('.electronic').hide();
    $('.property').hide();
    $('.transport').hide();
    $('.business').hide();
    $('.leisure').hide();
    $('.jobs').hide();
    $('.cat-forms').css('background', 'none');

    $('#slogan').show("slow");

});
//$('.wrap').click(function(){
//    $('.electronic').hide();
//$('.property').hide();
//$('.transport').hide();
//$('.leisure').hide();
//$('.business').hide();
//$('#slogan').show("slow");

//});
