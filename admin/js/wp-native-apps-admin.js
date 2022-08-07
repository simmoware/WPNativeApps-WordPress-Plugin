(function( $ ) {
	'use strict';
	 	$(window).load(function(){
			$('.color-picker').wpColorPicker();

			$('a.tabcontrol').click(function(event){
				console.log('test');
				// event.preventDefault();
				var context = $('.wpna_tabs_wrap');
				$('a.tabcontrol', context).removeClass('nav-tab-active');
				$(this).addClass('nav-tab-active');
				$('div.tab-content', context).hide();
				$( 'div'+$(this).attr('targetTab'), context ).show();
			});
		});

})( jQuery );

function getTemplate(template, params, callback) {
    var $ = jQuery;
    $.ajax({
        url: WPNativeApps.pluginURL + "templates/" + template + ".html",
        success: function (data){
            for (var key in params) {
                var val = params[key];
                data = data.replace("[[" + key + "]]", val);
            }
            callback(data);
        }
    });
}

function cssPath(el) {
    if (!(el instanceof Element)) return;
    var path = [];
    while (el.nodeType === Node.ELEMENT_NODE) {
        var selector = el.nodeName.toLowerCase();
        if (el.id) {
            selector += '#' + el.id;
        } else if (el.className) {
            selector += '.' + el.className.replace(/ /g, ".");
        } else {
            var sib = el, nth = 1;
            while (sib.nodeType === Node.ELEMENT_NODE && (sib = sib.previousSibling) && nth++);
            selector += ":nth-child("+nth+")";
        }
        if (el.tagName !== "HTML" && el.tagName !== "BODY") {
            path.unshift(selector);
        }
        el = el.parentNode;
    }
    return path.join(" > ");
}

var selectedHeader = "";
var selectedFooter = "";

function buildiFrame(config) {
    var $ = jQuery;
    getTemplate(config.template, config, function (content) {
        $("body").append(content);
        $("#" + config.ID).on("load", function () {
            var iFrame = $("#" + config.ID).get(0);
            var iDoc = iFrame.contentWindow || iFrame.contentDocument;
            if (iDoc.document) {
                iDoc = iDoc.document;
                $(iDoc.body).find("*").each(function () {
                    this.addEventListener("mouseover", function (event) {
                        if (config.type == "element") {
                            var elementType = $(".elementSelection").val();
                            if (elementType == "Any" || elementType == event.target.tagName) {
                                $(event.target).css({
                                    outline: "8px solid red"
                                });
                            }
                        } else {
                            $(event.target).css({
                                outline: "8px solid red"
                            });
                        }
                    });
                    this.addEventListener("mouseout", function (event) {
                        handleHeaderFooterMouseOut(event, config.type);
                    });
                    this.addEventListener("click", function (event) {
                        event.preventDefault();
                        if (config.type == "element") {
                            var elementType = $(".elementSelection").val();
                            if (elementType == "Any" || elementType == event.target.tagName) {
                                handleHeaderFooterClick(event, config.type, iDoc);
                            }
                        } else {
                            handleHeaderFooterClick(event, config.type, iDoc);
                        }
                    });
                });
            };
        });
    });
}

function handleHeaderFooterMouseOut(event, type) {
    var $ = jQuery;
    if (type == "header") {
        if (cssPath(event.target) !== selectedHeader) {
            $(event.target).css({
                outline: "0px"
            });
        }
    } else if (type == "footer") {
        if (cssPath(event.target) !== selectedFooter) {
            $(event.target).css({
                outline: "0px"
            });
        }
    } else {
        if (cssPath(event.target) !== selectedElement) {
            $(event.target).css({
                outline: "0px"
            });
        }
    }
}

function handleHeaderFooterClick(event, type, iDoc) {
    var $ = jQuery;
    var path = cssPath(event.target);
    if (type == "header") {
        if (path !== selectedHeader) {
            $(iDoc.body).find(selectedHeader).css({
                outline: "0px"
            });
            selectedHeader = path;
            setHeaderInput();
        }
    } else if (type == "footer") {
        if (path !== selectedFooter) {
            $(iDoc.body).find(selectedFooter).css({
                outline: "0px"
            });
            selectedFooter = path;
            setFooterInput();
        }
    } else {
        if (path !== selectedElement) {
            console.log("true");
            $(iDoc.body).find(selectedElement).css({
                outline: "0px"
            });
            selectedElement = path;
            setElementInput();
        } else {
            console.log("false");
        }
    }
}

function buildHeaderiFrame() {
    selectedHeader = "";
    buildiFrame({
        ID:"header_selection_iframe",
        URL:WPNativeApps.homeURL + "?hidetoolbar=true",
        DISPLAY_URL:WPNativeApps.homeURL,
        template:"selection_popover",
        type:"header"
    });
}

function buildFooteriFrame() {
    selectedFooter = "";
    buildiFrame({
        ID:"footer_selection_iframe",
        URL:WPNativeApps.homeURL + "?hidetoolbar=true",
        DISPLAY_URL:WPNativeApps.homeURL,
        template:"selection_popover_footer",
        type:"footer"
    });
}

function buildElementiFrame() {
    selectedElement = "";
    buildiFrame({
        ID:"element_selection_iframe",
        URL:WPNativeApps.homeURL + "?hidetoolbar=true",
        DISPLAY_URL:WPNativeApps.homeURL,
        template:"selection_popover_element",
        type:"element"
    });
}

function selectChild(id, type) {
    var $ = jQuery;
    var iFrame = $("#" + id).get(0);
    var iDoc = iFrame.contentWindow || iFrame.contentDocument;
    if (iDoc.document) {
        iDoc = iDoc.document;
        var child = null;

        if (type == "header") {
            child = $(iDoc.body).find(selectedHeader).get(0).children[0];
        } else if (type == "footer") {
            child = $(iDoc.body).find(selectedFooter).get(0).children[0];
        } else {
            child = $(iDoc.body).find(selectedElement).get(0).children[0];
        }

        if (typeof child !== "undefined") {
            while (child.tagName == "SCRIPT" || child.tagName == "STYLE") {
                child = $(child).next().get(0);
            }
            var childPath = cssPath(child);
            if (type == "header") {
                $(iDoc.body).find(selectedHeader).css({
                    outline: "0px"
                });
                selectedHeader = childPath;
                setHeaderInput();
            } else if (type == "footer") {
                $(iDoc.body).find(selectedFooter).css({
                    outline: "0px"
                });
                selectedFooter = childPath;
                setFooterInput();
            } else {
                $(iDoc.body).find(selectedElement).css({
                    outline: "0px"
                });
                selectedElement = childPath;
                setElementInput();
            }
            $(child).css({
                outline: "8px solid red"
            });
        }
    }
}


function selectParent(id, type) {
    var $ = jQuery;
    var iFrame = $("#" + id).get(0);
    var iDoc = iFrame.contentWindow || iFrame.contentDocument;
    if (iDoc.document) {
        iDoc = iDoc.document;
        var parent = null;
        if (type == "header") {
            parent = $(iDoc.body).find(selectedHeader).get(0).parentNode;
        } else if (type == "footer") {
            parent = $(iDoc.body).find(selectedFooter).get(0).parentNode;
        } else {
            parent = $(iDoc.body).find(selectedElement).get(0).parentNode;
        }
        if (typeof parent !== "undefined" && parent.tagName !== "BODY" && parent.tagName !== "HTML") {
            var parentPath = cssPath(parent);
            if (type == "header") {
                $(iDoc.body).find(selectedHeader).css({
                    outline: "0px"
                });
                selectedHeader = parentPath;
                setHeaderInput();
            } else if (type == "footer") {
                $(iDoc.body).find(selectedFooter).css({
                    outline: "0px"
                });
                selectedFooter = parentPath;
                setFooterInput();
            } else {
                $(iDoc.body).find(selectedElement).css({
                    outline: "0px"
                });
                selectedElement = parentPath;
                setElementInput();
            }
            $(parent).css({
                outline: "8px solid red"
            });
        }
    }
}

function setHeaderInput() {
    var $ = jQuery;
    $(".selectionSelectorString").val(selectedHeader);
}

function setFooterInput() {
    var $ = jQuery;
    $(".selectionSelectorString").val(selectedFooter);
}

function setElementInput() {
    var $ = jQuery;
    $(".selectionSelectorString").val(selectedElement);
}

function doneSelection(type) {
    if (type == 'header') {
        jQuery("#wpna_hide_header").val(selectedHeader);
    } else if (type == 'footer') {
        jQuery("#wpna_hide_footer").val(selectedFooter);
    } else {
        jQuery("#wpna_hide_other").val(selectedElement);
    }
    jQuery(".iFrameWindow").remove();
}

function closeiFrameWindow(event) {
    var element = event.target;
    var $ = jQuery;
    var cl = $(element).attr('class');
    var ignores = [
        "iFrameContainer",
        "iFrameTitle",
        "iFrameNavigationWindow",
        "iFrameURL",
        "iFrameCloseWindow",
        "iFrameBackButton",
        "iFrameForwardButton",
        "selectionContainer",
        "selectionType",
        "elementSelection",
        "selectionSelector",
        "selectionSelectorString",
        "selectionSelectorChild",
        "selectionSelectorParent",
        "selectionDone",
        "selectionDoneButton"
    ];

    if ($.inArray(cl, ignores) == -1 && typeof cl !== "undefined") {
        while (!$(element).hasClass("iFrameWindow")) {
            element = $(element).parent();
        }
        $(element).remove();
    }
}

//===========================================================================================//
//========================== Settings -> Navigation -> Bottom Bar Script STARTS ============//

//Function to handle Link Type change action.
function handleBottomBarLinkTypeChange(el){
		$=jQuery;
		var type = $(el).val();
		const section = $(el).parents('.navigationBottomBarItem');

		switch (type){
			case 'page':
			{
				section.find('select.bottomBarItemUrlInternal').show();
				section.find('input.bottomBarItemUrlExternal').hide();
				break;
			}

			case 'external':
			{
					section.find('select.bottomBarItemUrlInternal').hide();
					section.find('input.bottomBarItemUrlExternal').show();
					break;
			}
		}
}

//===== Script to add new navigationIcon item in Navigation Tab STARTS===============//
jQuery(document).ready(function($){
	$('#addBottomNavigationIcon').on('click',function(){
		var count = document.querySelectorAll('.navigationBottomBarItem').length;
		// var count = parseInt(iconCount +1);
		if (count <= 4 ){
			var newIconHtml = $('#navigationBottomBarItemGeneric').html();
			newIconHtml = newIconHtml.replaceAll('{{iconcount}}',count+1);
			console.log(count);
			if(count >2){
				var removeIcon = '<span id="removeBottomBarNavigationIcon" class="button" onclick="javascript:removeBottomBarNavigationIcon();">Remove</span>';
			}else{
				var removeIcon = '';
			}


			$('span#removeBottomBarNavigationIcon').remove();
			$('.navigationBottomBarItem:nth(0)').parent().append('<div class="flex-column navigationBottomBarItem">'+newIconHtml+'</div>'+removeIcon);

			if(count == 4){
				$('#addBottomNavigationIcon').hide();
			}else{
				$('#addBottomNavigationIcon').show();
			}
		}
	});
});

function removeBottomBarNavigationIcon(){
	$=jQuery;
	var count = parseInt(document.querySelectorAll('.navigationBottomBarItem').length) -1;
	// console.log(count);
	if(count >= 3){
		if(confirm("Do you want to remove this?")){
			$('.navigationBottomBarItem:nth('+count+')').remove();
			$('#addBottomNavigationIcon').show();
			if(count == 3){
				$('span#removeBottomBarNavigationIcon').remove();
			}
		}

	}
}
//===== Script to add/remvoe navigationIcon item in Navigation for Bottom BarTab ENDS=============//

//===========================================================================================//
//========================== Settings -> Navigation -> Bottom Bar Script ENDS ==============//


//===========================================================================================//
//========================== Settings -> Navigation -> Hamburger Menu STARTS ============//
//Function to handle Link Type change action.
function handleHamburgerLinkTypeChange(el){
		$=jQuery;
		var type = $(el).val();
		const section = $(el).parents('.navigationHamburgerItem');

		switch (type){
			case 'page':
			{
				section.find('select.hamburgerItemUrlInternal').show();
				section.find('input.hamburgerItemUrlExternal').hide();
				break;
			}

			case 'external':
			{
					section.find('select.hamburgerItemUrlInternal').hide();
					section.find('input.hamburgerItemUrlExternal').show();
					break;
			}
		}
}
//===== Script to add/remove navigationIcon item in Hamburger Section of Navigation Tab STARTS===============//
jQuery(document).ready(function($){
	$('#addHamburgerNavigationIcon').on('click',function(){
		var count = document.querySelectorAll('.navigationHamburgerItem').length;
		// var count = parseInt(iconCount +1);
		if (count <= 4 ){
			var newIconHtml = $('#navigationHamburgerItemGeneric').html();
			newIconHtml = newIconHtml.replaceAll('{{iconcount}}',count+1);
			console.log(count);
			if(count >2){
				var removeIcon = '<span id="removeHamburgerNavigationIcon" class="button" onclick="javascript:removeHamburgerNavigationIcon();">Remove</span>';
			}else{
				var removeIcon = '';
			}


			$('span#removeHamburgerNavigationIcon').remove();
			$('.navigationHamburgerItem:nth(0)').parent().append('<div class="flex-column navigationHamburgerItem">'+newIconHtml+'</div>'+removeIcon);

			if(count == 4){
				$('#addHamburgerNavigationIcon').hide();
			}else{
				$('#addHamburgerNavigationIcon').show();
			}
		}
	});
});

function removeHamburgerNavigationIcon(){
	$=jQuery;
	var count = parseInt(document.querySelectorAll('.navigationHamburgerItem').length) -1;
	// console.log(count);
	if(count >= 3){
		if(confirm("Do you want to remove this?")){
			$('.navigationHamburgerItem:nth('+count+')').remove();
			$('#addHamburgerNavigationIcon').show();
			if(count == 3){
				$('span#removeHamburgerNavigationIcon').remove();
			}
		}

	}
}
//===== Script to add/remove navigationIcon item in Hamburger Section of Navigation Tab ENDS===============//
