var popupStatus = 0;

function loadPopup()
{
    if(popupStatus==0)
    {
        $("#backgroundPopup").css({
            "opacity": "0.7"
        });
        $("#backgroundPopup").fadeIn("slow");
        $("#popup").fadeIn("slow");
        popupStatus = 1;
    }
}

function disablePopup()
{
    if(popupStatus==1)
    {
        $("#backgroundPopup").fadeOut("slow");
        $("#popup").fadeOut("slow");
        popupStatus = 0;
    }
}

function centerPopup()
{
    var windowWidth = document.documentElement.clientWidth;
    var windowHeight = document.documentElement.clientHeight;
    var popupHeight = $("#popup").height();
    var popupWidth = $("#popup").width();
	
    //"top": windowHeight/2-popupHeight/2,
    //"left": windowWidth/2-popupWidth/2


    $("#popup").css({
        "position": "absolute",
		"top": ( $(window).height() - popupHeight ) / 2 + $(window).scrollTop() + "px",
		"left": ( $(window).width() - popupWidth ) / 2 + $(window).scrollLeft() + "px"
    });
    
    $("#backgroundPopup").css({
        "height": windowHeight
    });    
}