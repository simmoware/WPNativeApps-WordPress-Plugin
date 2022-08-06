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

//========================== Settings -> Navigation -> Bottom Bar Script STARTS ============//

jQuery(document).ready(function($){
	$('select.bottomBarItemType').on('change',function(){
		var type = $(this).val();
		const section = $(this).parents('.navigationBottomBarItem');

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
	});

	$('select.bottomBarItemUrlInternal').on('change',function(){
		var pageName = $(this).children("option:selected").text();
		const section = $(this).parents('.navigationBottomBarItem');
		section.find('input.bottomBarItemText').val(pageName);


	})

});



//========================== Settings -> Navigation -> Bottom Bar Script ENDS ==============//
