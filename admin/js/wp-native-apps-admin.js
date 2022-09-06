var topNavTabs = null;
(function( $ ) {
	'use strict';
	 	$(window).load(function(){
			$('.color-picker').wpColorPicker();
			document.currentTabInput = getUrlParameter('section');
			document.topNavTabsCurrent = getUrlParameter('topnav');
			// var selectedMainTab = $('input#something').val();
			// var topNav = $('input#something').val();
			// var settingsMainTab = $('#wpna_settings_tabs').tabs({active : $('input#currentTab').val()});
			var settingsMainTab = $('#wpna_settings_tabs').tabs({active :  document.currentTabInput });
			// this.topNavTabs = $('#topNavTabs').tabs({active : $('input#topNavTabsCurrent').val()});
			this.topNavTabs = $('#topNavTabs').tabs({active :  document.topNavTabsCurrent });

			$('a.tabcontrol').click(function(event){
				console.log('test');
				// event.preventDefault();
				var context = $('.wpna_tabs_wrap');
				$('a.tabcontrol', context).removeClass('nav-tab-active');
				$(this).addClass('nav-tab-active');
				$('div.tab-content', context).addClass('hide');
				$( 'div'+$(this).attr('targetTab'), context ).removeClass('hide');
			});

      $("#wpPayNow").on("click press", function(){
        $.ajax({
            url: "http://localhost:8080/v1/subscription/checkout/setup-payment?returnUrl="+$(this).attr("data-returnurl"),
            headers: {
                'WPNativeAppsId': $(this).attr("data-wpnativeappsid"),
                'WPNativeAppsSecret': $(this).attr("data-wpnativeappssecret"),
                'WPNativeAppsRequestKey': 'sO4nl&W5sVTpBOQ#Wo07bJGMdJTZ&isi$HTe#j3x'
            },
            success: function(result){
            if(result.success){
                    window.location.href = result.checkout.url;
            }
            console.log("Result from AJAX: ", result)
            }
        });
      })
		});


		$(window).resize(function () {
		   setiPhoneFrame();
		});

	$(document).on('change','#accountAddressCountry',function(){
		var country = $(this).val();
		console.log(country);
		console.log('Render State here...');
	});

})( jQuery );
$=jQuery;

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

$(document).on('click','#wpna_settings_tabs li.settingsTab',function(){
	$('input#currentTabInput').val($(this).index());
	// document.currentTabInput =  $(this).index();
	// console.log($(this).index());
});

$(document).on('click','li.topNavTabs',function(){
	$('input#topNavTabsCurrent').val($(this).index());
	// document.topNavTabsCurrent =  $(this).index();
	// console.log($(this).index());
});

function add_element_to_hide(el){
	var elementCount = $(el).parents('.general_hideElements').find('.otherHideElement').length;
	var __count = parseInt(elementCount) + 1;
	$('a#removeHideItem').remove();
	var hideElementHtml = `
	<div class="hideOtherItemWrap">
		<h4>Is there anything else you want to hide?</h4>
		<div class="flex-row jc-sb ai-fe selectorInputs">
			<div class="flex-row">
				<input
							type="text"
							name="otherHide[]"
							class="otherHideElement"
							value=""
							required
				/>
				<div class="flex-column">
					<div class="choose_button_with_icon" onclick="buildElementiFrame(${__count});"><a href="javascript:void(0);" class="" data-title="Select Element to Hide">Choose Element</a><span class="arrow_north"></span></div>
				</div>
				<div class="removeIcon"> <a id="removeHideItem" class="button trash" href="javascript:void(0);" onclick="removeHideItem(this)"> Remove </a> </div>
			</div>
		</div>
	</div>
	`
	$(el).before(hideElementHtml);

}
function removeHideItem(el){
	var elementCount = $(el).parents('.general_hideElements').find('.otherHideElement').length;
	$(el).parents('.hideOtherItemWrap').remove();
	var count = parseInt(elementCount) - 1;
	console.log(count);
	if(count > 1){
		// $('.hideOtherItemWrap:last').append('Hello world');
		$('.hideOtherItemWrap:last').find('.removeIcon').html('<a id="removeHideItem" class="button trash" href="javascript:void(0);" onclick="removeHideItem(this)"> Remove </a>');

	}
}

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
    if (typeof el.nodeName === "undefined") {
        return;
    }

    var path = [];
    //while (el.nodeType === Node.ELEMENT_NODE) {
    while (el !== null) {
        if (el.nodeName !== "#document") {
            var selector = el.nodeName.toLowerCase();
            if (el.id) {
                selector += '#' + el.id;
            } else if (el.className) {
                selector += '.' + el.className.replace(/ /g, ".");
            } else {
                var sib = el, nth = 1;
                while (sib.nodeType === Node.ELEMENT_NODE && (sib = sib.previousSibling) && nth++);
                //selector += ":nth-child("+nth+")";
            }
            if (el.tagName !== "HTML" && el.tagName !== "BODY") {
                path.unshift(selector);
            }
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
        setTimeout(function () {
            setiPhoneFrame();
        }, 500);
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
            var selected = $(iDoc.body).find(selectedHeader).get(0);
            if (!$(selected).is(":visible")) {
                $(selected).fadeIn();
                $(".selectionApplyButton").text("Apply");
            }
            selectedHeader = path;
            setHeaderInput();
        }
    } else if (type == "footer") {
        if (path !== selectedFooter) {
            $(iDoc.body).find(selectedFooter).css({
                outline: "0px"
            });
            var selected = $(iDoc.body).find(selectedFooter).get(0);
            if (!$(selected).is(":visible")) {
                $(selected).fadeIn();
                $(".selectionApplyButton").text("Apply");
            }
            selectedFooter = path;
            setFooterInput();
        }
    } else {
        if (path !== selectedElement) {
            console.log("true");
            $(iDoc.body).find(selectedElement).css({
                outline: "0px"
            });
            var selected = $(iDoc.body).find(selectedElement).get(0);
            if (!$(selected).is(":visible")) {
                $(selected).fadeIn();
                $(".selectionApplyButton").text("Apply");
            }
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

var elementSelectioniFrameIndex = -1;

function buildElementiFrame(index) {
    elementSelectioniFrameIndex = index;
    selectedElement = "";
    buildiFrame({
        ID:"element_selection_iframe",
        URL:WPNativeApps.homeURL + "?hidetoolbar=true",
        DISPLAY_URL:WPNativeApps.homeURL,
        template:"selection_popover_element",
        type:"element"
    });
}

function selectNext(id, type) {
    var $ = jQuery;
    var iFrame = $("#" + id).get(0);
    var iDoc = iFrame.contentWindow || iFrame.contentDocument;
    var currentSelector = "";

    if (iDoc.document) {
        iDoc = iDoc.document;
        var child = null;

        if (type == "header") {
            child = $(iDoc.body).find(selectedHeader).get(0);
            currentSelector = selectedHeader;
            if (typeof child !== "undefined") {
                if (child.nextSibling !== null) {
                    var siblingTest = child;
                    var nextCount = 0;
                    while (siblingTest.nextSibling !== null && nextCount == 0) {
                        if (typeof siblingTest.nextSibling.tagName === "undefined") {
                            siblingTest = siblingTest.nextSibling;
                            child = siblingTest;
                            nextCount = 1;
                        }
                    }
                    child = siblingTest;
                    if (typeof child.nextSibling.tagName !== "undefined") {
                        child = child.nextSibling;
                    }
                }
            }
        } else if (type == "footer") {
            child = $(iDoc.body).find(selectedFooter).get(0);
            currentSelector = selectedFooter;
            if (typeof child !== "undefined") {
                if (child.nextSibling !== null) {
                    var siblingTest = child;
                    while (typeof siblingTest.nextSibling.tagName === "undefined" && siblingTest.nextSibling !== null) {
                        siblingTest = siblingTest.nextSibling;
                    }
                    child = siblingTest;
                    if (typeof child.nextSibling.tagName !== "undefined") {
                        child = child.nextSibling;
                    }
                }
            }
        } else {
            child = $(iDoc.body).find(selectedElement).get(0);
            currentSelector = selectedElement;
            if (typeof child !== "undefined") {
                if (child.nextSibling !== null) {
                    var siblingTest = child;
                    while (typeof siblingTest.nextSibling.tagName === "undefined" && siblingTest.nextSibling !== null) {
                        siblingTest = siblingTest.nextSibling;
                    }
                    child = siblingTest;
                    if (typeof child.nextSibling.tagName !== "undefined") {
                        child = child.nextSibling;
                    }
                }
            }
        }

        var newCssPath = cssPath(child);
        if (newCssPath !== currentSelector) {
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
}


function selectPrev(id, type) {
    var $ = jQuery;
    var iFrame = $("#" + id).get(0);
    var iDoc = iFrame.contentWindow || iFrame.contentDocument;
    var currentSelector = "";

    if (iDoc.document) {
        iDoc = iDoc.document;
        var child = null;

        if (type == "header") {
            child = $(iDoc.body).find(selectedHeader).get(0);
            currentSelector = selectedHeader;
            if (typeof child !== "undefined") {
                if (child.previousSibling !== null) {
                    if (typeof child.previousSibling.tagName !== "undefined") {
                        child = child.previousSibling;
                    }
                }
            }
        } else if (type == "footer") {
            child = $(iDoc.body).find(selectedFooter).get(0);
            currentSelector = selectedFooter;
            if (typeof child !== "undefined") {
                if (child.previousSibling !== null) {
                    if (typeof child.previousSibling.tagName !== "undefined") {
                        child = child.previousSibling;
                    }
                }
            }
        } else {
            child = $(iDoc.body).find(selectedElement).get(0);
            currentSelector = selectedElement;
            if (typeof child !== "undefined") {
                if (child.previousSibling !== null) {
                    if (typeof child.previousSibling.tagName !== "undefined") {
                        child = child.previousSibling;
                    }
                }
            }
        }

        var newCssPath = cssPath(child);
        if (newCssPath !== currentSelector) {
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

function setiPhoneFrame() {
    var $ = jQuery;
    var iFrameShadowBox = $(".iFrameWindow").get(0);
    if (typeof iFrameShadowBox !== "undefined") {
        var iPhoneFrame = $(".iFrameiPhoneFrame").get(0);
        var iframe = $(".iFramePopoverElement").get(0);
        var iPhoneWidthScale = 1.1143923363;
        var iPhoneHeightScale = 2.1641025641
        $(".iFrameContainer iframe").css({
           width: $(".iFrame_Half_Container").innerWidth()*0.9,
           height: $(".iFrame_Half_Container").innerWidth()*0.9*iPhoneHeightScale
        });
        var iFrameWidth = $(iframe).outerWidth();
        var width = iFrameWidth * iPhoneWidthScale;
        var height = width*iPhoneHeightScale;
        var leftOffset = (iFrameWidth-width)/-2;
        var pos = $(iframe).offset();
        $(iPhoneFrame).css({
           top:58,
           left:pos.left - leftOffset,
           width:width,
           height:height*0.9383155397,
           opacity:1
        });
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
        jQuery("#headerToHide").val(selectedHeader);
    } else if (type == 'footer') {
        jQuery("#footerToHide").val(selectedFooter);
    } else {
        var others = jQuery(".otherHideElement").toArray();
        console.log(others);
        var theOther = others[elementSelectioniFrameIndex-1];
        theOther.value = selectedElement;
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
        "selectionDoneButton",
        "iFrame_Half_Container",
        "iFrame_Half_ContainerH3",
        "iFrame_Half_ContainerH5",
        "iFrame_Half_ContainerP",
        "iFrame_SelectorTools_Container",
        "selectionSelectorPrev",
        "selectionSelectorNext",
        "selectionApplyButton",
        "selectionDoneButton",
        "iFrameiPhoneFrame",
        "iFramePopoverElement",
        "iFrame_Phone_Container",
        "iFrameNavigationWindow",
        "iFrameEditURLButton"
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
				section.find('select.bottomBarItemUrlInternal').removeClass('hide');
				section.find('input.bottomBarItemUrlExternal').addClass('hide');
				break;
			}

			case 'external':
			{
					section.find('select.bottomBarItemUrlInternal').addClass('hide');
					section.find('input.bottomBarItemUrlExternal').removeClass('hide');
					break;
			}
		}
}
function handleHamburgerMenuLinkTypeChange(el){
		$=jQuery;
		var type = $(el).val();
		const section = $(el).parents('.topNavPageIconItem');
		switch (type){
			case 'page':
			{
				section.find('select.topNavItemUrlInternal').removeClass('hide');
				section.find('input.topNavItemUrlExternal').addClass('hide');
				break;
			}

			case 'external':
			{
					section.find('select.topNavItemUrlInternal').addClass('hide');
					section.find('input.topNavItemUrlExternal').removeClass('hide');
					break;
			}
			case 'share':
			{
				section.find('select.topNavItemUrlInternal').addClass('hide');
				section.find('input.topNavItemUrlExternal').addClass('hide');
				break;
			}
		}
}



// When Page is slected from dropdown, copy the page name to Label input.
	$(document).on('change','select.bottomBarItemUrlInternal',function(){
		var pageName = $(this).find(":selected").text();
		const section = $(this).parents('.navigationBottomBarItem');
		section.find('input.bottomBarItemText').val(pageName);

		// Update the Tab name in Top Nav Tab as well when Page Name Changes Here
		var name = $(this).attr('name');
		console.log(name);
		var count = parseInt(name.replace(/[^0-9.]/g, ""));
		console.log(count);
		var iconUrl = $(this).parents('.navigationBottomBarItem').find('input.wpna_img_url').val();
		console.log(iconUrl);
		$('ul#topNavTabsControl li:nth-child('+count+') a').html('<img src="'+iconUrl+'" class="topNavPageIcon">'+pageName);
		updateTopNavNameIcon(count,iconUrl,pageName)
	});




function updateTopNavTabName(el){
	var pageName = $(el).val();
	var iconUrl = $(el).parents('.navigationBottomBarItem').find('input.wpna_img_url').val();
	var count = parseInt($(el).attr('data-itemcount'));
	console.log(count)
	console.log(iconUrl)
	console.log(navTitle)
	updateTopNavNameIcon(count,iconUrl,pageName)
}
function updateTopNavNameIcon(count=1,iconUrl='',pageName='Home'){
	$('ul#topNavTabsControl li:nth-child('+count+') a').html('<img src="'+iconUrl+'" class="topNavPageIcon">'+pageName);
}
//===== Script to add new navigationIcon item in Navigation Tab STARTS===============//
/*
jQuery(document).ready(function($){
	topNavTabs = $('#topNavTabs').tabs();
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
			addTopNavTabsItem(topNavTabs,count);

			if(count == 4){
				$('#addBottomNavigationIcon').addClass('hide');
			}else{
				$('#addBottomNavigationIcon').removeClass('hide');
			}
		}
	});
});
*/



function showMaxItemAddedMessage(count){
	alert('Max items added already, will add html later!!')
}
function addBottomBarNavigationIcon(el){
		var section = $(el).parent().parent().find('.navigationBottomBarItems');
		// var count = document.querySelectorAll('.navigationBottomBarItem').length;
		var count = $(section).find('.navigationBottomBarItem').length;
		// var count = parseInt(iconCount +1);
		if (count <= 4 ){
			var newIconHtml = $('#navigationBottomBarItemGeneric').html();
			newIconHtml = newIconHtml.replaceAll('{{iconcount}}',count+1);
			console.log(count);
			if(count >= 1 ){
				var removeIcon = '<span id="removeBottomBarNavigationIcon" class="button" onclick="removeBottomBarNavigationIcon(this);">Remove</span>';
			}else{
				var removeIcon = '';
			}


			$('span#removeBottomBarNavigationIcon').remove();

			$(section).append('<div class="flex-column navigationBottomBarItem">'+newIconHtml + removeIcon+'</div>');


			addTopNavTabsItem(count);

			if(count == 4){
				$('#addBottomNavigationIcon').addClass('hide');
			}else{
				$('#addBottomNavigationIcon').removeClass('hide');
			}
		}else{
			showMaxItemAddedMessage();
		}

		// Re-initialize the color picker for added pickers
		var pickerCount = parseInt(count+1);
		$('.color-picker'+pickerCount).wpColorPicker();

}
function removeBottomBarNavigationIcon(el){

	$=jQuery;
	var section = $(el).parents('.navigationBottomBarItems');
	var count = parseInt($(section).find('.navigationBottomBarItem').length -1);
	console.log(count);


	// console.log(count);
	if(count >= 1){
		if(confirm("Do you want to remove this?")){
			$(section).find('.navigationBottomBarItem:nth('+count+')').remove();
			removeTopNavTabsItem(count);
			$('#addBottomNavigationIcon').removeClass('hide');
			if(count > 1){
				$(section).find('.navigationBottomBarItem').last().append('<span id="removeBottomBarNavigationIcon" class="button" onclick="removeBottomBarNavigationIcon(this);">Remove</span>');
				// $('span#removeBottomBarNavigationIcon').remove();
			}
		}

	}
}

function addTopNavTabsItem(count){

	var count = count+1;
	var topNavTabs = this.topNavTabs;
	console.log(topNavTabs);
	var topNavTabs = $('#topNavTabs').tabs();
	console.log(topNavTabs);

	var label = $('input.bottomBarItemText.item_'+count).val() || 'Page';
	var icon = $('input[name="bottomBarItemIcon_'+count+'_image_url"]').val();

	var tabTemplate = '<li class="topNavTabs"><a href="#{{topNavTabId}}"><span class="topNavPageIcon"></span>{{topNavTabLabel}}</li></a>';
	var tabContent = $('#topNavIndividualPageSetupGeneric').html();


		// var label = tabTitle.val() || "Tab " + tabCounter,
		id = "topNavPage_"+count;
		li = $( tabTemplate.replaceAll('{{topNavTabId}}',id).replaceAll('{{topNavTabLabel}}',label));
		tabContentHtml = tabContent.replaceAll('{{bottomBarpagecount}}', count);


	topNavTabs.find( ".ui-tabs-nav" ).append( li );



	// topNavTabs.append('<div id="topNavPage_'+count+'" data-pagecount="'+count+'" class="topNavPageSettings flex-column ui-tabs-panel ui-corner-bottom ui-widget-content">');
	// topNavTabs.find('div#'+id).removeAll();
	topNavTabs.append( '<div id="topNavPage_'+count+'" data-pagecount="'+count+'" class="topNavPageSettings flex-column ui-tabs-panel ui-corner-bottom ui-widget-content">'+tabContentHtml+'</div>' );
	// topNavTabs.append( "<div id='" + id + "' class='flex-column '>" + tabContentHtml + "</div>" );
	topNavTabs.tabs( "refresh" );
	this.topNavTabs = topNavTabs;

}

function removeTopNavTabsItem(count){
	var topNavTabs =	this.topNavTabs;
	// var topNavTabs = $('#topNavTabs').tabs();
	$('li[aria-controls="topNavPage_'+count+'"]').remove();
	$('#topNavPage_'+count).remove();
  topNavTabs.tabs( "refresh" );
	this.topNavTabs = topNavTabs;
}

/*
$(document).on('change','.navigation_bottomBar_section input.bottomBarItemText',function(){
	var name = $(this).attr('name');

	var count = parseInt(name.replace(/[^0-9.]/g, ""));
	$('ul#topNavTabsControl li:nth-child('+count+') a').text($(this).val());

});
*/


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
				section.find('select.hamburgerItemUrlInternal').removeClass('hide');
				section.find('input.hamburgerItemUrlExternal').addClass('hide');
				break;
			}

			case 'external':
			{
					section.find('select.hamburgerItemUrlInternal').addClass('hide');
					section.find('input.hamburgerItemUrlExternal').removeClass('hide');
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
				$('#addHamburgerNavigationIcon').addClass('hide');
			}else{
				$('#addHamburgerNavigationIcon').removeClass('hide');
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
			$('#addHamburgerNavigationIcon').removeClass('hide');
			if(count == 3){
				$('span#removeHamburgerNavigationIcon').remove();
			}
		}

	}
}
//===== Script to add/remove navigationIcon item in Hamburger Section of Navigation Tab ENDS===============//

$(document).ready(function() {
	/*
	$(".settingSelect input[type='radio']").on('change', function() {
		$(".topNav_optionParent").each(function() {
			$(this).find(".settingParent").addClass("hide");
		});
		var topNavOptionParent = findOptionParent(this, "topNav_optionParent");
		$(topNavOptionParent).find(".settingParent").removeClass("hide");
	});
	*/

/*
	$(".optionRadio input").on("change", function() {
		var optionParent = findOptionParent(this, 'optionParent');
		var selectedOptionNumber = $(optionParent).attr("data-id");
		$(optionParent).parent().find(".optionParent").each(function() {
			if ($(this).attr('data-id') != selectedOptionNumber) {
				$(this).find(".conditionalSettings").addClass("hide");
			}
		});
		$(optionParent).find('.conditionalSettings').removeClass("hide");
	});
	*/
/*
	function findOptionParent(el, name) {
		while (!$(el).hasClass(name)) {
			el = $(el).parent();
		}
		return el;
	}
	*/
});

$(document).on("change", ".settingSelect input[type='radio']",function(){

		$(".topNav_optionParent").each(function() {
			$(this).find(".settingParent").addClass("hide");
		});
		var topNavOptionParent = findOptionParent(this, "topNav_optionParent");
		$(topNavOptionParent).find(".settingParent").removeClass("hide");

});

$(document).on("change", ".optionRadio input", function() {
	var optionParent = findOptionParent(this, 'optionParent');
	var selectedOptionNumber = $(optionParent).attr("data-id");
	$(optionParent).parent().find(".optionParent").each(function() {
		if ($(this).attr('data-id') != selectedOptionNumber) {
			$(this).find(".conditionalSettings").addClass("hide");
		}
	});
	$(optionParent).find('.conditionalSettings').removeClass("hide");
});

function findOptionParent(el, name) {
	while (!$(el).hasClass(name)) {
		el = $(el).parent();
	}
	return el;
}



//======== Top Nav Tab Scripts =========
function handleTopNavLinkTypeChange(el){
	$=jQuery;
	var type = $(el).val();
	const section = $(el).parents('.topNavPageIconItem');
	console.log(type);
	console.log(section);
	switch (type){
		case 'page':
		{
			section.find('select.topNavItemUrlInternal').removeClass('hide');
			section.find('input.topNavItemUrlExternal').addClass('hide');
			break;
		}

		case 'external':
		{
				section.find('select.topNavItemUrlInternal').addClass('hide');
				section.find('input.topNavItemUrlExternal').removeClass('hide');
				break;
		}
		case 'share':
		{
			section.find('select.topNavItemUrlInternal').addClass('hide');
			section.find('input.topNavItemUrlExternal').addClass('hide');
			break;
		}
	}
}

function addTopNavNavigationIcon(el){

			var section = $(el).parents('section.navStructureRow');
			var pagecount = $(el).parents('.topNavPageSettings').attr('data-pagecount');
			var structureCount = $(el).parents('.navStructureRow').attr('data-structure');
			var navItemsCount = parseInt($(section).find('.topNavPageIconItem').length);





			// var count = document.querySelectorAll('navigation_bottomBar_section .navigationBottomBarItem').length;
			// var count = parseInt(iconCount +1);
			if (navItemsCount <= 2 ){
				var newIconHtml = $('#topNavNaviagionIconGeneric').html();
				newIconHtml = newIconHtml.replaceAll('{{iconCount}}',navItemsCount+1).replaceAll('{{topNavTabCount}}',pagecount).replaceAll('{{structureCount}}',structureCount);
				if(navItemsCount >=1){
					var removeIcon = '<span class="button removeNavigationIconRow" onclick="removeTopNavigationIconForPage(this);">Remove</span>';
				}else{
					var removeIcon = '';
				}


				$(section).find('span.removeNavigationIconRow').remove();

				$(el).parent().before('<div class="flex-column topNavPageIconItem">'+newIconHtml+'</div>'+removeIcon);

				if(navItemsCount == 2){
					$(section).find('.addNewNavigationIcon').addClass('hide');
				}else{
					$(section).find('.addNewNavigationIcon').removeClass('hide');
				}
			}else{
				showMaxItemAddedMessage();
				// console.log('Max item added!');
			}



}
function removeTopNavigationIconForPage(el){
	$=jQuery;
	var section = $(el).parents('section.navStructureRow');

	var count = parseInt($(section).find('.topNavPageIconItem').length);
	// console.log(count);
	// if(count >= 1){
		if(confirm("Do you want to remove this?")){
			$(section).find('.topNavPageIconItem:nth('+(count-1)+')').remove()
			// $(removeel).remove();
			$(section).find('.addNewNavigationIcon').removeClass('hide');
			console.log(count);
			if(count == 2){
					$(section).find('span.removeNavigationIconRow').remove();
			}
		}

	// }
}
